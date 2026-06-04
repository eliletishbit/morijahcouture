FROM php:8.2-fpm

# Installe les dépendances système et l'extension PDO MySQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql zip

# Copie ton code
COPY . /var/www/html
WORKDIR /var/www/html

CMD ["php-fpm"]