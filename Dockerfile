# Utilise une image PHP avec Apache déjà configuré
FROM php:8.2-apache

# Installation des extensions nécessaires
RUN apt-get update && apt-get install -y libpng-dev libzip-dev \
    && docker-php-ext-install pdo_mysql zip

# Activer le rewrite module pour Laravel
RUN a2enmod rewrite

# Copier les fichiers
COPY . /var/www/html

# Configurer le répertoire public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Donner les permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80