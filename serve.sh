#!/usr/bin/env bash
set -euo pipefail
cd "$(dirname "$0")"

STREAM_APP="rtsp-stream"
STARTED=0
CLEANED=0
SERVER_PID=""
VITE_PID=""

cleanup() {
    if [ "$CLEANED" = "1" ]; then return; fi
    CLEANED=1
    echo ""
    if [ -n "${VITE_PID:-}" ]; then
        echo "[serve.sh] menghentikan Vite dev server (pid $VITE_PID)..."
        kill "$VITE_PID" 2>/dev/null || true
        wait "$VITE_PID" 2>/dev/null || true
    fi
    if [ -n "${SERVER_PID:-}" ]; then
        echo "[serve.sh] menghentikan Laravel server (pid $SERVER_PID)..."
        kill "$SERVER_PID" 2>/dev/null || true
        wait "$SERVER_PID" 2>/dev/null || true
    fi
    if [ "$STARTED" = "1" ]; then
        echo "[serve.sh] menghentikan PM2 '$STREAM_APP'..."
        pm2 stop "$STREAM_APP" --silent >/dev/null 2>&1 || true
    fi
}
trap cleanup EXIT INT TERM

if command -v pm2 >/dev/null 2>&1 && [ -f ecosystem.config.cjs ]; then
    if pm2 describe "$STREAM_APP" >/dev/null 2>&1; then
        echo "[serve.sh] PM2 '$STREAM_APP' sedang berjalan -> restart"
        pm2 restart "$STREAM_APP" --update-env --silent
    else
        echo "[serve.sh] memulai PM2 '$STREAM_APP' (stream service)..."
        pm2 start ecosystem.config.cjs --silent
    fi
    STARTED=1
    echo "[serve.sh] Stream service aktif. Lihat log: pm2 logs $STREAM_APP"
else
    echo "[serve.sh] WARN: pm2 belum terinstall -> hanya Laravel server. (npm i -g pm2)"
fi

echo "[serve.sh] menjalankan Vite dev server..."
npm run dev &
VITE_PID=$!

echo "[serve.sh] Laravel server: http://localhost:8000  (Ctrl-C utk berhenti)"
echo "------------------------------------------------------------"

php artisan serve &
SERVER_PID=$!
wait "$SERVER_PID"
