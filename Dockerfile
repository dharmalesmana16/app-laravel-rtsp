# === Stage 1: build Vite assets ===
FROM node:20-bookworm AS frontend
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY . .
RUN npm run build

# === Stage 2: Laravel (PHP-FPM + Nginx + supervisor) ===
FROM php:8.4-fpm-bookworm

# sistem + ekstensi PHP + nginx + supervisor
RUN apt-get update && apt-get install -y --no-install-recommends \
        nginx supervisor git zip unzip curl \
        libpng-dev libonig-dev libxml2-dev libzip-dev libicu-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl zip opcache \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# 1) Dependency PHP dulu — cache hanya invalid saat composer.json/lock berubah.
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# 2) Salin kode aplikasi + asset hasil build Vite.
COPY --chown=www-data:www-data . .
COPY --from=frontend --chown=www-data:www-data /app/public/build ./public/build

# 3) Regenerasi autoloader + package discovery (kode lengkap).
#    rm cache bootstrap agar manifest stale (mis. CollisionServiceProvider
#    dari dev) tak ikut -- di-regenerate sesuai paket terinstall (--no-dev).
RUN composer dump-autoload --optimize --no-dev \
    && rm -f bootstrap/cache/*.php \
    && php artisan package:discover --ansi

# konfigurasi
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
