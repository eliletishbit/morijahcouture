FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    nginx libpng-dev libzip-dev zip unzip git nodejs npm \
    && docker-php-ext-install pdo_mysql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configuration Nginx avec règles CORS
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
    location ~* \.(js|css|woff2|woff|ttf|png|jpg|jpeg|gif|ico|svg)$ { \
        add_header Access-Control-Allow-Origin *; \
        expires max; \
        log_not_found off; \
    } \
}' > /etc/nginx/sites-available/default

WORKDIR /var/www/html

# 1. Copier les fichiers de dépendances
COPY composer.json composer.lock ./

# Installer les dépendances (y compris les dev pour Faker)
RUN composer install --optimize-autoloader --no-scripts

COPY package.json package-lock.json ./
RUN npm install

# 2. Copier tout le code source
COPY . .

# 3. Builder les assets Vite
RUN APP_URL=https://morijahcouture-production.up.railway.app ./node_modules/.bin/vite build

# 4. Créer le fichier SQLite dans /tmp (accessible en écriture)
RUN touch /tmp/database.sqlite && chmod 664 /tmp/database.sqlite
RUN chown www-data:www-data /tmp/database.sqlite
RUN ln -sf /tmp/database.sqlite /var/www/html/database/database.sqlite

# 5. Forcer l'utilisation de SQLite pendant le build (écrase le .env local)
ENV DB_CONNECTION=sqlite
ENV DB_DATABASE=/tmp/database.sqlite
ENV LOG_CHANNEL=null

# 6. Exécuter les migrations et les seeders (Faker est maintenant installé)
RUN php artisan migrate --seed --force

# 7. Permissions pour Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 8. Entrypoint (pour les permissions à l'exécution)
USER root
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]