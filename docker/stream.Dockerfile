# Stream service: Node + ffmpeg + PM2
FROM node:20-bookworm

RUN apt-get update \
    && apt-get install -y --no-install-recommends ffmpeg \
    && rm -rf /var/lib/apt/lists/* \
    && npm i -g pm2

WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci --omit=dev

COPY ecosystem.config.cjs ./
COPY resources/js ./resources/js

# pm2-runtime jalan di foreground (Docker-friendly)
CMD ["pm2-runtime", "ecosystem.config.cjs"]
