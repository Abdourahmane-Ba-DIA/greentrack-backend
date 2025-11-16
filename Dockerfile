# Étape 1 : PHP 8.2 FPM avec extensions nécessaires
FROM php:8.2-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le dossier de travail
WORKDIR /var/www

# Copier le code Laravel
COPY . .

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Définir la variable d'environnement APP_KEY dans Docker
# Remplace 'ta_cle_laravel' par la clé générée localement
ENV APP_KEY=base64:7AZd8gYBr4MbvM5ToGQeSBA7zWCDH8EbgB9hjVyrTkg=

# Exposer le port pour Render
EXPOSE 8000

# Lancer Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
