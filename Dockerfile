FROM php:8.2-apache

# Installation des extensions nécessaires
RUN apt-get update && apt-get install -y libzip-dev zip unzip libpng-dev libjpeg-dev libfreetype6-dev libpq-dev nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql pdo_pgsql zip \
    && a2enmod rewrite

# Installation Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Build et installation
RUN composer install --no-dev --optimize-autoloader \
    && npm install && npm run build \
    && php artisan config:cache && php artisan route:cache && php artisan view:cache

RUN chown -R www-data:www-data /var/www/html/storage && chmod -R 775 /var/www/html/storage

# --- CONFIGURATION PROPRE (Sans déplacer de fichiers) ---
# 1. On modifie directement le DocumentRoot d'Apache
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# 2. On autorise les .htaccess (indispensable pour Laravel)
RUN sed -i '/<Directory \/var\/www\/html\/public>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/sites-available/000-default.conf

# 3. On ajuste le port
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80
CMD apache2-foreground