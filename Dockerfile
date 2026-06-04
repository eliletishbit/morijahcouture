# 1. Utiliser une image PHP-FPM seule (pas d'Apache !)
FROM php:8.2-fpm

# 2. Installation de Nginx et dépendances
RUN apt-get update && apt-get install -y \
    nginx libpng-dev libzip-dev zip unzip git nodejs npm \
    && docker-php-ext-install pdo_mysql zip

# 3. Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Configuration Nginx minimale (crée un fichier de config simple)
RUN echo 'server { \
    listen 80; \
    index index.php index.html; \
    root /var/www/html/public; \
    location / { try_files $uri $uri/ /index.php?$query_string; } \
    location ~ \.php$ { \
        fastcgi_pass 127.0.0.1:9000; \
        fastcgi_index index.php; \
        include fastcgi_params; \
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name; \
    } \
}' > /etc/nginx/sites-available/default

WORKDIR /var/www/html

# 5. Dépendances PHP et JS
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run build

# 6. Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 7. Lancer les DEUX services : Nginx (web) et PHP-FPM (traitement)
EXPOSE 80
CMD service nginx start && php-fpm