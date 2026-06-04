FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip libpng-dev libjpeg-dev libfreetype6-dev libpq-dev \
    nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql pdo_pgsql zip \
    && a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader \
    && npm install \
    && npm run build \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

RUN chown -R www-data:www-data /var/www/html/storage \
    && chmod -R 775 /var/www/html/storage

# Radical : On déplace public à la racine pour qu'Apache le trouve sans config spéciale
RUN mv /var/www/html/public/* /var/www/html/ && \
    rm -rf /var/www/html/public

# On s'assure que le .htaccess est bien pris en compte
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf

EXPOSE 80
CMD apache2-foreground