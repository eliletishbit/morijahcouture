#!/bin/bash

# Créer les dossiers nécessaires
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache

# Forcer les permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Fichier SQLite dans /tmp (accessible en écriture)
touch /tmp/database.sqlite
chown www-data:www-data /tmp/database.sqlite
chmod 664 /tmp/database.sqlite

# Lien symbolique vers /tmp pour que Laravel le trouve
ln -sf /tmp/database.sqlite /var/www/html/database/database.sqlite

# Exécuter les migrations
php artisan migrate --seed --force

# Démarrer Nginx et PHP-FPM
service nginx start
php-fpm -F