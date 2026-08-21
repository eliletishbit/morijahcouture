#!/bin/bash

# Créer les dossiers s'ils n'existent pas
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache

# Forcer les permissions avec sudo
sudo chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
sudo chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Créer le fichier SQLite
touch /var/www/html/database/database.sqlite
sudo chown www-data:www-data /var/www/html/database/database.sqlite
sudo chmod 664 /var/www/html/database/database.sqlite

# Lancer les migrations
php artisan migrate --seed --force

# Démarrer les services
sudo service nginx start
sudo php-fpm -F