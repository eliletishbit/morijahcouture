#!/bin/bash

# S'assurer que les dossiers storage et bootstrap/cache existent et ont les bonnes permissions
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Créer le fichier SQLite s'il n'existe pas
touch /var/www/html/database/database.sqlite

# Exécuter les migrations et les seeders
php artisan migrate --seed --force

# Lancer Nginx et PHP-FPM
service nginx start
php-fpm -F