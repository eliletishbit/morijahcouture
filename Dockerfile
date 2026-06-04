# Utilise l'image officielle PHP 8.2 avec Apache
FROM php:8.2-apache

# Installation des extensions système nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql pdo_pgsql zip \
    && a2enmod rewrite

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définition du répertoire de travail
WORKDIR /var/www/html

# Copie des fichiers du projet
COPY . .

# Installation des dépendances du projet
RUN composer install --no-dev --optimize-autoloader

# Mise en cache de la configuration Laravel
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Attribution des permissions correctes pour Laravel
RUN chown -R www-data:www-data /var/www/html/storage \
    && chmod -R 775 /var/www/html/storage

# Configuration d'Apache pour utiliser la variable PORT de Render
# On remplace le port 80 par la variable ${PORT} dans les fichiers Apache
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Exposition du port
EXPOSE 80

# Lancement du serveur Apache
CMD apache2-foreground