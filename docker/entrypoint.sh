#!/bin/sh
set -e

cd /var/www/html

echo "[entrypoint] Booting Laravel application..."

# Serve uploaded files from storage via the public/storage symlink.
php artisan storage:link --relative || true

# Generate APP_KEY only when it is not already provided via the environment.
if [ -z "${APP_KEY}" ]; then
    echo "[entrypoint] APP_KEY not set; generating a random key..."
    export APP_KEY="$(php artisan key:generate --show)"
fi

# The config cache was baked at build time from build-time defaults.
# Runtime env vars (DB_HOST, APP_URL, etc.) are injected by Dokku, so the
# stale snapshot is discarded here and the config is loaded fresh from env.
if [ -f bootstrap/cache/config.php ]; then
    php artisan config:clear
fi

if [ "${RUN_MIGRATIONS}" = "true" ]; then
    echo "[entrypoint] Running database migrations..."
    attempt=1
    while [ "${attempt}" -le 30 ]; do
        if php artisan migrate --force; then
            echo "[entrypoint] Migrations complete."
            break
        fi
        echo "[entrypoint] Migration attempt ${attempt}/30 failed; retrying in 5s..."
        attempt=$((attempt + 1))
        sleep 5
    done
    if [ "${attempt}" -gt 30 ]; then
        echo "[entrypoint] Migrations failed after 30 attempts; aborting."
        exit 1
    fi
fi

echo "[entrypoint] Starting php-fpm and nginx..."
exec /usr/bin/supervisord -c /etc/supervisord.conf
