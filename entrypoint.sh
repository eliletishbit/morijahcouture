#!/bin/bash

# Créer les dossiers
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache

# Forcer les permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Fichier SQLite
touch /var/www/html/database/database.sqlite
chown www-data:www-data /var/www/html/database/database.sqlite
chmod 664 /var/www/html/database/database.sqlite

# Migrations
php artisan migrate --seed --force

# Services
service nginx start
php-fpm -F