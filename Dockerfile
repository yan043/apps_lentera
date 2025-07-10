FROM php:8.2-apache

RUN apt update && apt install -y \
    git unzip curl libzip-dev zip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data /var/www/html

RUN composer install --no-scripts --no-plugins --ignore-platform-req=ext-gd -vvv
RUN cp .env.example .env
RUN php artisan key:generate

EXPOSE 80
