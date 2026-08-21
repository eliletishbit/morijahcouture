#!/bin/bash

echo "=== Starting entrypoint ==="

mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# S'assurer que le lien symbolique vers SQLite existe
ln -sf /tmp/database.sqlite /var/www/html/database/database.sqlite

# (Les migrations sont déjà exécutées pendant le build, mais on les relance au cas où)
php artisan migrate --seed --force --verbose || echo "Migration in entrypoint failed"

service nginx start
php-fpm -F