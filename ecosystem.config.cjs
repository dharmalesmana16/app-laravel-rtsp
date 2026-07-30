// PM2 ecosystem — rekomendasi produksi (ganti nodemon).
// Membaca .env Laravel agar token & config stream service ter-inject otomatis
// (stream.js baca process.env, BUKAN .env Laravel langsung).
//
// Jalankan langsung:
//   pm2 start ecosystem.config.cjs
//   pm2 logs rtsp-stream
// Atau via wrapper dev:  ./serve.sh

const fs = require("fs");
const path = require("path");

function loadEnv(file) {
  const env = {};
  try {
    const txt = fs.readFileSync(file, "utf8");
    for (const line of txt.split("\n")) {
      const m = line.match(/^\s*([A-Z_][A-Z0-9_]*)\s*=\s*(.*)$/);
      if (!m) continue;
      let v = m[2].trim();
      if ((v[0] === '"' && v[v.length - 1] === '"') || (v[0] === "'" && v[v.length - 1] === "'")) {
        v = v.slice(1, -1);
      }
      env[m[1]] = v;
    }
  } catch (_) {
    // .env tidak ditemukan -> gunakan default stream.js
  }
  return env;
}

const e = loadEnv(path.join(__dirname, ".env"));

// Prefer .env (non-Docker), lalu process.env (Docker/compose), lalu default.
const pick = (k, def) => e[k] || process.env[k] || def;

module.exports = {
  apps: [
    {
      name: "rtsp-stream",
      script: "./resources/js/stream.js",
      instances: 1,
      exec_mode: "fork",
      autorestart: true,
      max_restarts: 20,
      restart_delay: 3000,
      max_memory_restart: "512M",
      watch: false,
      env: {
        NODE_ENV: pick("NODE_ENV", "production"),
        API_URL: pick("API_URL", "http://localhost:8000"),
        STREAM_SERVICE_TOKEN: pick("STREAM_SERVICE_TOKEN", ""),
        MAX_CONCURRENT_STREAMS: pick("MAX_CONCURRENT_STREAMS", ""),
        MAX_RECONNECT_ATTEMPTS: pick("MAX_RECONNECT_ATTEMPTS", ""),
        STREAM_COOLDOWN_MS: pick("STREAM_COOLDOWN_MS", ""),
        RESYNC_INTERVAL_MS: pick("RESYNC_INTERVAL_MS", ""),
        LOG_LEVEL: pick("LOG_LEVEL", "info"),
      },
    },
  ],
};
