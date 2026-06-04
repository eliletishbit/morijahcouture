# Utilise l'image officielle PHP 8.2 avec Apache
FROM php:8.2-apache

# 1. Installation des dépendances système
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip libpng-dev libjpeg-dev libfreetype6-dev libpq-dev \
    nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql pdo_pgsql zip \
    && a2enmod rewrite

# 2. Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Définition du répertoire de travail
WORKDIR /var/www/html

# 4. Copie des fichiers du projet
COPY . .

# 5. Installation des dépendances PHP et compilation des assets
RUN composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build

# 6. Mise en cache de la configuration Laravel
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# 7. Attribution des permissions
RUN chown -R www-data:www-data /var/www/html/storage \
    && chmod -R 775 /var/www/html/storage

# 8. Forcer Apache à pointer vers le dossier public et autoriser les .htaccess
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/apache2.conf \
    && sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# 9. Configuration du port dynamique pour Render
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# 10. Exposition du port et démarrage
EXPOSE 80
CMD apache2-foreground