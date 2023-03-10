FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install -j$(nproc) mbstring \
    && docker-php-ext-install -j$(nproc) zip \
    && docker-php-ext-install -j$(nproc) pdo_mysql \
    && a2enmod rewrite

WORKDIR /var/www/html
COPY . .
COPY .env.docker /var/www/html/.env

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --prefer-dist --no-interaction

RUN php artisan key:generate
RUN php artisan migrate:fresh
RUN php artisan db:seed

RUN chown -R www-data:www-data /var/www/html

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000