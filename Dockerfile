# ---- Base image PHP ----
FROM php:8.2-fpm

# ---- Install system dependencies ----
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# ---- Install Composer ----
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# ---- Copy application files ----
WORKDIR /var/www/html
COPY . .

# ---- Install PHP dependencies ----
RUN composer install --no-interaction --optimize-autoloader --no-dev

# ---- Laravel storage & cache permissions ----
RUN mkdir -p storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# ---- Copy and allow entrypoint ----
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 8000

ENTRYPOINT ["/entrypoint.sh"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
