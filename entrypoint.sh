#!/bin/bash

# Créer le fichier SQLite s'il n'existe pas
touch /var/www/html/database/database.sqlite

# Exécuter les migrations et les seeders
php artisan migrate --seed --force

# Lancer Nginx et PHP-FPM
service nginx start
php-fpm -F