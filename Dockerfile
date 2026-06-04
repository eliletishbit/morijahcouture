FROM php:8.2-fpm

# Installation des extensions
RUN apt-get update && apt-get install -y libpng-dev libzip-dev \
    && docker-php-ext-install pdo_mysql zip

# Définition du répertoire de travail
WORKDIR /var/www/html

# Copie des fichiers
COPY . .

# Permissions nécessaires pour Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exposer le port 8000 (standard pour PHP local)
EXPOSE 8000

# Commande de démarrage simple
CMD php artisan serve --host=0.0.0.0 --port=8000