#!/usr/bin/env bash
# Jalankan environment DEV (hot-reload kode PHP/Blade tanpa rebuild per ubahan).
# - bind-mount source, APP_ENV=local, APP_DEBUG=true
# - composer/npm tetap dari image (anonymous volume vendor)
set -euo pipefail
cd "$(dirname "$0")"

docker compose -f docker-compose.yml -f docker-compose.dev.yml up -d --build
echo ""
echo "[dev] siap. Buka http://localhost  (login admin@example.com / password)"
echo "[dev] ubah file PHP/Blade -> auto refleksi (Laravel baca file live)."
echo "[dev] ubah frontend (js/css) -> jalankan: docker compose exec app sh -c 'cd ../.. && npm run build'  atau rebuild."
