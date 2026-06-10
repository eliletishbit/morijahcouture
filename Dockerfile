# 1. Utiliser une image PHP-FPM
FROM php:8.2-fpm

# 2. Installation de Nginx et dépendances
RUN apt-get update && apt-get install -y \
    nginx \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    nodejs \
    npm \
    curl \
    && docker-php-ext-install pdo_mysql zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# 3. Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Configuration Nginx
RUN echo 'server { \
    listen 80; \
    server_name _; \
    root /var/www/html/public; \
    index index.php index.html; \
    add_header X-Frame-Options "SAMEORIGIN" always; \
    add_header X-Content-Type-Options "nosniff" always; \
    add_header X-XSS-Protection "1; mode=block" always; \
    charset utf-8; \
    location / { \
        try_files $uri $uri/ /index.php?$query_string; \
    } \
    location ~ \.php$ { \
        fastcgi_pass 127.0.0.1:9000; \
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name; \
        include fastcgi_params; \
    } \
    location ~ /\.(?!well-known).* { \
        deny all; \
    } \
}' > /etc/nginx/sites-available/default

WORKDIR /var/www/html

# 5. Copier les fichiers de dépendances
COPY composer.json composer.lock ./
COPY package.json package-lock.json ./

# 6. Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader --no-scripts

# 7. Installer les dépendances Node.js
RUN npm install

# 8. Copier tout le reste du code source
COPY . .

# 9. Builder les assets Vite
RUN npm run build

# 10. Permissions pour Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 11. Exposer le port
EXPOSE 80

# 12. Commande de démarrage (sans cache config)
CMD php artisan storage:link && service nginx start && php-fpm -F