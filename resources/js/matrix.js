const GRID_SELECTOR = "#stream-grid";

const RETRY_BASE_MS = 1000;
const RETRY_MAX_MS = 30000;

function boot() {
    const grid = document.querySelector(GRID_SELECTOR);
    if (!grid) return;
    initStreamGrid(grid);
}

function initStreamGrid(grid) {
    const POLL_MS = Number(grid.dataset.pollMs || 5000);

    const players = new Map();
    let lastSignature = "";
    let firstPoll = true;

    function destroyRec(rec) {
        if (!rec) return;
        rec.destroyed = true;
        if (rec.retryTimer) clearTimeout(rec.retryTimer);
        try {
            rec.player?.stop();
        } catch (_) {
        }
    }

    function scheduleRetry(rec) {
        if (rec.destroyed) return;
        const delay = Math.min(RETRY_MAX_MS, RETRY_BASE_MS * 2 ** rec.attempts);
        rec.attempts += 1;
        rec.retryTimer = setTimeout(() => {
            rec.retryTimer = null;
            connectStream(rec.id, rec.port, rec.canvas);
        }, delay);
    }

    function connectStream(id, port, canvas) {
        const prev = players.get(id);
        if (prev) destroyRec(prev);

        let rec;
        const ws = new WebSocket(window.streamWsUrl(port));
        rec = {
            id,
            port,
            canvas,
            ws,
            player: null,
            retryTimer: null,
            attempts: 0,
            destroyed: false,
        };
        players.set(id, rec);

        ws.onerror = () => {
            try {
                ws.close();
            } catch (_) {
            }
        };
        ws.onclose = () => {
            if (!rec.destroyed) scheduleRetry(rec);
        };

        rec.player = new jsmpeg(ws, {
            canvas,
            autoplay: true,
            loop: true,
            ondecodeframe: () => {
                if (rec.attempts !== 0) rec.attempts = 0;
            },
        });
    }

    function disconnectStream(id) {
        const rec = players.get(id);
        if (rec) destroyRec(rec);
        players.delete(id);
    }

    // ---- Shared streaming modal ----
    const modal = document.getElementById("stream-modal");

    function openModal(port) {
        if (!modal) return;
        modal.classList.remove("hidden");
        const canvas = modal.querySelector("canvas[data-modal-canvas]");
        if (canvas) connectStream("modal", Number(port), canvas);
    }

    function closeModal() {
        if (!modal) return;
        modal.classList.add("hidden");
        disconnectStream("modal");
    }

    document.addEventListener("click", (event) => {
        const openBtn = event.target.closest("[data-stream-open]");
        if (openBtn) {
            openModal(openBtn.dataset.port);
            return;
        }
        if (event.target.closest("[data-modal-close]") || event.target === modal) {
            closeModal();
        }
    });

    // ---- Grid reconciliation ----
    function reconcilePlayers() {
        for (const [id, rec] of [...players]) {
            if (id === "modal") continue;
            const card = grid.querySelector(`[data-stream-card][data-camera-id="${id}"]`);
            if (!card) {
                destroyRec(rec);
                players.delete(id);
                continue;
            }
            const canvas = card.querySelector("canvas[data-stream-canvas]");
            const port = Number(card.dataset.port);
            if (!canvas) continue;
            if (port !== rec.port || canvas !== rec.canvas) {
                connectStream(id, port, canvas);
            } else {
                rec.canvas = canvas;
            }
        }

        for (const card of grid.querySelectorAll("[data-stream-card]")) {
            const id = card.dataset.cameraId;
            if (players.has(id)) continue;
            const canvas = card.querySelector("canvas[data-stream-canvas]");
            if (canvas) connectStream(id, Number(card.dataset.port), canvas);
        }
    }

    async function refreshGrid() {
        let res;
        try {
            res = await fetch("/matrix/items", {
                headers: { Accept: "text/html" },
                credentials: "same-origin",
            });
        } catch (_) {
            return;
        }
        if (!res.ok) return;
        const html = await res.text();
        const doc = new DOMParser().parseFromString(html, "text/html");

        const fragment = document.createDocumentFragment();
        for (const el of [...doc.body.children]) fragment.appendChild(el);

        // Pertahankan stream kamera yang tak berubah dengan memindahkan
        // <canvas> lama (yang sedang digambar player) ke kartu baru.
        for (const card of doc.querySelectorAll("[data-stream-card]")) {
            const id = card.dataset.cameraId;
            const rec = players.get(id);
            if (!rec) continue;
            const newCanvas = card.querySelector("canvas[data-stream-canvas]");
            const oldCard = grid.querySelector(`[data-stream-card][data-camera-id="${id}"]`);
            const oldCanvas = oldCard?.querySelector("canvas[data-stream-canvas]");
            if (rec.port === Number(card.dataset.port) && oldCanvas && newCanvas) {
                newCanvas.replaceWith(oldCanvas);
            }
        }

        grid.replaceChildren(fragment);
        reconcilePlayers();
    }

    async function fetchCameras() {
        const res = await fetch("/api/camera", {
            headers: {
                Accept: "application/json",
                "X-Requested-With": "XMLHttpRequest",
            },
            credentials: "same-origin",
        });
        if (!res.ok) return null;
        const body = await res.json();
        return (body.data || []).map((camera) => ({
            id: String(camera.id),
            key: [
                camera.id,
                camera.http_port,
                camera.ip,
                camera.brand,
                camera.tipe,
                camera.channel,
                camera.resolusi,
                camera.vendor_name,
            ].join("|"),
        }));
    }

    async function poll() {
        let cameras;
        try {
            cameras = await fetchCameras();
        } catch (_) {
            return;
        }
        if (!cameras) return;

        const sig = cameras.map((c) => c.key).join(";");
        if (firstPoll) {
            firstPoll = false;
            lastSignature = sig;
            return;
        }
        if (sig !== lastSignature) {
            lastSignature = sig;
            await refreshGrid();
        }
    }

    reconcilePlayers();
    poll();
    setInterval(poll, POLL_MS);
}

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", boot);
} else {
    // Pastikan body app.js (window.streamWsUrl) sudah dieksekusi.
    setTimeout(boot, 0);
}
