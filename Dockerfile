FROM php:8.2-fpm

RUN apt-get update -y && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    libzip-dev libicu-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . /app

RUN composer update --no-dev --optimize-autoloader --no-interaction
RUN php artisan config:cache
RUN php artisan route:cache
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8080
CMD php artisan serve --host=0.0.0.0 --port=8080
