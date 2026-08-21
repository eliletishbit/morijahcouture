#!/bin/bash

echo "=== Starting entrypoint ==="

mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Exécuter les migrations (et seed si besoin) avec les variables d'environnement Render
php artisan migrate --force

# Optionnel : lancer les seeders (si tu as des données de test)
php artisan db:seed --force

# Démarrer Nginx et PHP-FPM
service nginx start
php-fpm -F