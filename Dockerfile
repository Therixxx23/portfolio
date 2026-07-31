# syntax=docker/dockerfile:1

# =============================================================
# Stage 1 — Frontend assets (Vite build)
# =============================================================
FROM node:22-alpine AS assets

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY . .
RUN npm run build

# =============================================================
# Stage 2 — PHP-FPM + Nginx runtime
# =============================================================
FROM php:8.2-fpm-alpine

# mbstring, curl, opcache and sodium are already compiled into the base image.
# $PHPIZE_DEPS provides the compiler toolchain required by docker-php-ext-install.
RUN apk add --no-cache nginx supervisor $PHPIZE_DEPS \
        libzip-dev icu-dev \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql zip intl bcmath \
    && apk del --no-cache $PHPIZE_DEPS libzip-dev icu-dev

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# App source (vendor, node_modules, .env and build output excluded via .dockerignore)
COPY . .

# Fresh Vite build from stage 1 (overwrites anything stale under public/build)
COPY --from=assets /app/public/build /var/www/html/public/build

RUN composer install --no-dev --optimize-autoloader --no-interaction \
    && rm -f .env

# Writable runtime dirs, framework caches and ownership
RUN mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R u+rwX storage bootstrap/cache

COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/zz-laravel.ini
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
