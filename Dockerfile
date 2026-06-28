FROM php:8.2-cli

RUN apt-get update -y && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . /app

RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs
RUN php artisan config:cache
RUN php artisan route:cache
RUN rm -rf public/storage
RUN php artisan storage:link || true
EXPOSE 8080
EXPOSE 8080
CMD php artisan serve --host=0.0.0.0 --port 8080
