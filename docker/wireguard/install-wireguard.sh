#!/usr/bin/env bash
# Instal WireGuard di VPS (HOST), aktifkan wg0.conf, enable IP forwarding.
# Container stream (Docker bridge) lalu otomatis reach kamera via route host.
#
# Pakai:  sudo ./docker/wireguard/install-wireguard.sh
set -e

CONFIG="/etc/wireguard/wg0.conf"

# 1. install wireguard
if ! command -v wg >/dev/null 2>&1; then
  echo "[wg] menginstall wireguard..."
  apt-get update -y
  apt-get install -y wireguard
fi

mkdir -p /etc/wireguard

# 2. cek config
if [ ! -f "$CONFIG" ]; then
  echo "[wg] $CONFIG TIDAK ADA. Lakukan:"
  echo "    sudo cp docker/wireguard/wg0.conf.example $CONFIG"
  echo "    sudo nano $CONFIG   # isi PrivateKey, PublicKey peer, Endpoint, AllowedIPs (subnet kamera)"
  exit 1
fi

# 3. IP forwarding (wajib agar Docker bridge bisa route via wg0)
sysctl -w net.ipv4.ip_forward=1 >/dev/null
grep -q '^net.ipv4.ip_forward=1' /etc/sysctl.conf || echo 'net.ipv4.ip_forward=1' >> /etc/sysctl.conf

# 4. aktifkan & start
systemctl enable wg-quick@wg0
systemctl restart wg-quick@wg0

echo "[wg] status:"
wg show
echo ""
echo "[wg] selesai. Tes reachability kamera:"
echo "    docker compose exec stream sh -c 'command -v ffprobe >/dev/null && ffprobe -rtsp_transport tcp -i \"rtsp://USER:PASS@<IP-KAMERA-VIA-WG>:554/...\"'"
