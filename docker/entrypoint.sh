#!/bin/sh
set -e

cd /var/www/html

# Generate APP_KEY bila kosong
if [ -z "$APP_KEY" ]; then
    if [ "$APP_ENV" = "production" ]; then
        echo "[entrypoint] FATAL: APP_KEY kosong di production. Set APP_KEY di environment."
        exit 1
    fi
    echo "[entrypoint] APP_KEY kosong (dev mode), generate..."
    php artisan key:generate --force
fi

# Permission storage
mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Database (tunggu otomatis via depends_on healthcheck di compose)
php artisan migrate --force

# Cache hanya di produksi (mode local: live reload tanpa cache)
if [ "$APP_ENV" != "local" ]; then
    php artisan config:cache || true
    php artisan route:cache || true
    php artisan view:cache || true
fi
php artisan storage:link 2>/dev/null || true

exec "$@"
