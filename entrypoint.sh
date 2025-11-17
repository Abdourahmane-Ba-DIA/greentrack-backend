#!/bin/sh

# Copy .env from environment variables set in Render if not already present
if [ ! -f .env ]; then
    echo "APP_KEY=${APP_KEY}" >> .env
    echo "APP_ENV=production" >> .env
    echo "APP_DEBUG=false" >> .env
    echo "APP_URL=${APP_URL}" >> .env

    echo "DB_CONNECTION=pgsql" >> .env
    echo "DB_HOST=${DB_HOST}" >> .env
    echo "DB_PORT=5432" >> .env
    echo "DB_DATABASE=${DB_DATABASE}" >> .env
    echo "DB_USERNAME=${DB_USERNAME}" >> .env
    echo "DB_PASSWORD=${DB_PASSWORD}" >> .env
fi

# Run Laravel commands
php artisan key:generate --force
php artisan config:cache
php artisan migrate --force

exec "$@"
