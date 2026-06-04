# 1. Image de base avec PHP et Apache
FROM php:8.2-apache

# 2. Installation des dépendances système (NodeJS inclus)
RUN apt-get update && apt-get install -y \
    libpng-dev libzip-dev zip unzip git \
    nodejs npm

# 3. Extensions PHP
RUN docker-php-ext-install pdo_mysql zip

# 4. Activer le rewrite module (indispensable pour Laravel)
RUN a2enmod rewrite

# 5. Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. Configurer le répertoire public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

# 7. Installation dépendances PHP
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# 8. Installation dépendances JS et Build
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run build

# 9. Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 10. Apache écoute sur le port 80
EXPOSE 80