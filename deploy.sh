#!/usr/bin/env bash
# Deploy PRODUKSI — jalankan di server setelah push kode baru.
# Asumsi: .env produksi sudah benar, image base sudah ada (build cepat via cache).
set -euo pipefail
cd "$(dirname "$0")"

echo "==> [1/4] git pull..."
git pull --ff-only

echo "==> [2/4] build image (cache dependency — hanya rebuild yg berubah)..."
docker compose build app stream

echo "==> [3/4] jalankan container baru (entrypoint auto migrate + cache)..."
docker compose up -d --remove-orphans

echo "==> [4/4] restart stream service (re-fetch cred/config terbaru)..."
docker compose restart stream

echo ""
echo "==> Deploy selesai ✓"
docker compose ps
