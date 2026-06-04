FROM php:8.2-fpm

# 1. Installation des dépendances système
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git

# 2. Installation de l'extension PDO MySQL
RUN docker-php-ext-install pdo_mysql zip

# 3. Installation de Composer (pour télécharger le dossier /vendor)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Définition du répertoire de travail
WORKDIR /var/www/html

# 5. Copie uniquement les fichiers de configuration des dépendances d'abord (pour optimiser le cache)
COPY composer.json composer.lock ./

# 6. Installation des dépendances
RUN composer install --no-dev --optimize-autoloader --no-scripts

# 7. Copie tout le reste du code
COPY . .

# 8. Permissions nécessaires pour Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]