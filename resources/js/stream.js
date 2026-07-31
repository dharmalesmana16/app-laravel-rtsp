import { availableParallelism, cpus } from "node:os";
import { spawn } from "node:child_process";
import { createServer } from "node:http";
import axios from "axios";
import RtspStream from "node-rtsp-stream";
import { createLogger } from "./lib/logger.js";
import { createPool } from "./lib/pool.js";

const API_URL = process.env.API_URL || "http://localhost:8000";
const SERVICE_TOKEN = process.env.STREAM_SERVICE_TOKEN;
const RESYNC_INTERVAL_MS = Number(process.env.RESYNC_INTERVAL_MS || 60000);
const BACKOFF_MAX_MS = 30000;
const MAX_RECONNECT_ATTEMPTS = Number(process.env.MAX_RECONNECT_ATTEMPTS || 10);
const COOLDOWN_MS = Number(process.env.STREAM_COOLDOWN_MS || 300000);

const CONTROL_PORT = Number(process.env.STREAM_CONTROL_PORT || 8020);
const CONTROL_TOKEN = process.env.STREAM_CONTROL_TOKEN || SERVICE_TOKEN;

const cpuCount = (() => {
  try {
    return (typeof availableParallelism === "function" ? availableParallelism() : null) ?? cpus().length ?? 4;
  } catch (_) {
    return 4;
  }
})();
const MAX_CONCURRENT = Number(process.env.MAX_CONCURRENT_STREAMS || Math.max(4, cpuCount * 2));

const logger = createLogger({ service: "rtsp-stream" });

if (!SERVICE_TOKEN) {
  logger.error("STREAM_SERVICE_TOKEN tidak diset. Service berhenti.");
  process.exit(1);
}

const http = axios.create({
  baseURL: API_URL,
  timeout: 10000,
  headers: { Authorization: `Bearer ${SERVICE_TOKEN}` },
});

const states = new Map();

const cooldown = new Map();

const ffmpegArgs = (url) => ["-rtsp_transport", "tcp", "-i", url, "-f", "mpeg1video", "-"];

function spawnFfmpeg(url) {
  return spawn("ffmpeg", ffmpegArgs(url), { detached: false });
}

function pipeToWs(videoStream, child) {
  child.stdout.on("data", (data) => {
    try {
      videoStream.wsServer?.broadcast?.(data);
    } catch (_) {

    }
  });
  child.stderr.on("data", () => {

  });
}

function watchChild(camId, child) {
  if (!child || typeof child.on !== "function") return;
  let dead = false;
  const onDead = (reason) => {
    if (dead) return;
    dead = true;
    logger.warn("ffmpeg mati", { cameraId: camId, reason });
    scheduleReconnect(camId);
  };
  child.on("exit", (code, signal) => onDead(`exit code=${code} signal=${signal}`));
  child.on("error", (err) => onDead(`error ${err.message}`));
}

function backoffDelay(attempts) {
  return Math.min(BACKOFF_MAX_MS, 1000 * 2 ** attempts);
}

async function acquireStream(cam) {
  const log = logger.child({ cameraId: cam.id });
  if (states.has(cam.id)) return;

  try {
    const { data } = await http.get(`/api/internal/camera/${cam.id}/rtsp`);
    if (!data || !data.url) {
      log.warn("URL kosong, slot dilepas");
      pool.release(cam.id);
      return;
    }
    const videoStream = new RtspStream({
      name: `cam-${cam.id}`,
      streamUrl: data.url,
      wsPort: cam.http_port,
    });
    const state = {
      cam,
      url: data.url,
      videoStream,
      child: videoStream.stream ?? null,
      timer: null,
      attempts: 0,
    };
    watchChild(cam.id, state.child);
    states.set(cam.id, state);
    log.info("stream aktif", { wsPort: cam.http_port });
  } catch (err) {
    log.error("gagal memulai stream", { error: err.message });
    pool.release(cam.id);
  }
}

function releaseStream(camId) {
  const st = states.get(camId);
  if (!st) return;
  if (st.timer) clearTimeout(st.timer);
  try {
    st.child?.kill();
  } catch (_) {

  }
  const srv = st.videoStream?.wsServer;
  if (srv) {
    try {
      srv.clients.forEach((c) => {
        try {
          c.terminate();
        } catch (_) {

        }
      });
    } catch (_) {

    }
    try {
      srv.close();
    } catch (_) {

    }
  }
  states.delete(camId);
}

async function respawn(camId) {
  const st = states.get(camId);
  if (!st) return;
  st.timer = null;
  const log = logger.child({ cameraId: camId });

  try {
    const { data } = await http.get(`/api/internal/camera/${camId}/rtsp`);
    if (data && data.url) st.url = data.url;
  } catch (err) {
    log.warn("re-fetch URL gagal", { error: err.message });
  }

  const child = spawnFfmpeg(st.url);
  st.child = child;
  pipeToWs(st.videoStream, child);
  watchChild(camId, child);
  st.attempts = 0;
  log.info("ffmpeg di-respawn");
}

function scheduleReconnect(camId) {
  const st = states.get(camId);
  if (!st || st.timer) return;
  st.attempts += 1;

  if (st.attempts > MAX_RECONNECT_ATTEMPTS) {
    logger.warn("slot dilepas setelah gagal berulang", {
      cameraId: camId,
      attempts: st.attempts,
      cooldownMs: COOLDOWN_MS,
    });
    cooldown.set(camId, Date.now() + COOLDOWN_MS);
    pool.release(camId);
    return;
  }

  const delay = backoffDelay(st.attempts);
  logger.info("reconnect terjadwal", {
    cameraId: camId,
    attempts: st.attempts,
    delayMs: delay,
  });
  st.timer = setTimeout(() => respawn(camId), delay);
}

/**
 * Resync satu kamera secara instan (dipicu sinyal CRUD dari Laravel).
 * forceRestart=true -> matikan stream lama lalu minta ulang agar URL RTSP
 * (yang di-fetch saat acquire) mengikuti data terbaru.
 */
async function refreshCamera(camId, { forceRestart = false } = {}) {
  const log = logger.child({ cameraId: camId });
  try {
    const { data } = await http.get(`/api/internal/camera/${camId}`);
    if (!data || !data.id) {
      log.warn("kamera tidak ditemukan, slot dilepas");
      cooldown.delete(camId);
      pool.release(camId);
      return;
    }
    cooldown.delete(camId);
    if (forceRestart) pool.release(camId);
    pool.request(data);
    log.info("kamera di-resync", { forceRestart });
  } catch (err) {
    log.warn("refresh kamera gagal", { error: err.message });
  }
}

function handleSignal(payload) {
  if (!payload || payload.type !== "camera.changed") return;
  const { id, action } = payload;
  if (!Number.isInteger(id) || id <= 0) return;

  logger.info("sinyal CRUD kamera diterima", { cameraId: id, action });

  switch (action) {
    case "updated":
      refreshCamera(id, { forceRestart: true });
      break;
    case "deleted":
      cooldown.delete(id);
      pool.release(id);
      break;
    case "created":
    default:
      refreshCamera(id, { forceRestart: false });
      break;
  }
}

function readBody(req) {
  return new Promise((resolve, reject) => {
    let body = "";
    req.on("data", (chunk) => {
      body += chunk;
      if (body.length > 65536) {
        reject(new Error("payload terlalu besar"));
        req.destroy();
      }
    });
    req.on("end", () => resolve(body));
    req.on("error", reject);
  });
}

function startControlServer() {
  const server = createServer(async (req, res) => {
    res.setHeader("Content-Type", "application/json");

    if (req.method !== "POST" || req.url !== "/sync") {
      res.writeHead(404);
      res.end(JSON.stringify({ ok: false, error: "not_found" }));
      return;
    }

    if (req.headers.authorization !== `Bearer ${CONTROL_TOKEN}`) {
      res.writeHead(401);
      res.end(JSON.stringify({ ok: false, error: "unauthorized" }));
      return;
    }

    try {
      const payload = JSON.parse((await readBody(req)) || "{}");
      handleSignal(payload);
      res.writeHead(202);
      res.end(JSON.stringify({ ok: true }));
    } catch (err) {
      res.writeHead(400);
      res.end(JSON.stringify({ ok: false, error: err.message }));
    }
  });

  server.on("error", (err) => {
    logger.error("control server error", { error: err.message });
  });

  server.listen(CONTROL_PORT, () => {
    logger.info("control server siap", { port: CONTROL_PORT });
  });
}

async function sync() {
  try {
    const { data } = await http.get("/api/internal/cameras");
    const cameras = (data && data.data) || [];
    const liveIds = new Set(cameras.map((c) => c.id));
    const now = Date.now();

    for (const [id, until] of cooldown) {
      if (until <= now) cooldown.delete(id);
    }

    for (const cam of cameras) {
      if (cooldown.has(cam.id)) continue;
      pool.request(cam);
    }

    for (const id of [...pool.activeIds(), ...pool.pendingIds()]) {
      if (!liveIds.has(id)) {
        logger.info("kamera dihapus dari backend, distop", { cameraId: id });
        cooldown.delete(id);
        pool.release(id);
      }
    }

    await Promise.all(
      pool.activeIds().map(async (id) => {
        try {
          await http.post(`/api/internal/camera/${id}/heartbeat`);
        } catch (_) {

        }
      })
    );

    logger.info("sync selesai", {
      active: pool.activeCount(),
      pending: pool.pendingCount(),
      cooldown: cooldown.size,
      maxConcurrent: MAX_CONCURRENT,
    });
    return true;
  } catch (err) {
    logger.error("gagal sync daftar kamera", { error: err.message });
    return false;
  }
}

async function shutdown(signal) {
  logger.info("shutdown dimulai", { signal, active: pool.activeCount() });
  for (const id of pool.activeIds()) {
    pool.release(id);
  }
  process.exit(0);
}

const pool = createPool({
  maxConcurrency: MAX_CONCURRENT,
  onAcquire: acquireStream,
  onRelease: releaseStream,
});

process.on("SIGTERM", () => shutdown("SIGTERM"));
process.on("SIGINT", () => shutdown("SIGINT"));
process.on("uncaughtException", (err) => {
  logger.error("uncaughtException", { error: err.message, stack: err.stack });
  process.exit(1);
});
process.on("unhandledRejection", (reason) => {
  logger.error("unhandledRejection", { reason: String(reason) });
  process.exit(1);
});

logger.info("service berjalan", {
  api: API_URL,
  maxConcurrent: MAX_CONCURRENT,
  cpuCount,
  resyncMs: RESYNC_INTERVAL_MS,
});

const SYNC_FAIL_MS = Number(process.env.SYNC_FAIL_MS || 10000);
let syncTimer = null;
let syncing = false;

function scheduleSync(delay) {
  if (syncTimer) clearTimeout(syncTimer);
  syncTimer = setTimeout(runSync, delay);
}

async function runSync() {
  if (syncing) return;
  syncing = true;
  let ok = false;
  try {
    ok = await sync();
  } finally {
    syncing = false;
  }
  scheduleSync(ok ? RESYNC_INTERVAL_MS : SYNC_FAIL_MS);
}

startControlServer();
runSync();
