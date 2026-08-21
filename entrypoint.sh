#!/bin/bash

echo "=== Starting entrypoint ==="

# Créer les dossiers
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache

# Permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Fichier SQLite
touch /tmp/database.sqlite
chown www-data:www-data /tmp/database.sqlite
chmod 664 /tmp/database.sqlite

# Lien symbolique vers /tmp
ln -sf /tmp/database.sqlite /var/www/html/database/database.sqlite

# Vérifier que le fichier existe bien
ls -la /tmp/database.sqlite
ls -la /var/www/html/database/database.sqlite

# Exécuter les migrations avec affichage des logs
echo "Running migrations..."
php artisan migrate --seed --force --verbose || echo "Migrations failed with error $?"

# Démarrer les services
echo "Starting nginx and PHP-FPM..."
service nginx start
php-fpm -F