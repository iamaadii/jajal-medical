FROM php:8.4-cli-alpine

WORKDIR /app

# Install system dependencies & PHP extensions
RUN apk add --no-cache \
    mysql-client \
    libzip-dev \
    zip \
    unzip \
    git \
    icu-dev \
    && docker-php-ext-install pdo pdo_mysql intl pcntl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Install PHP production dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

EXPOSE 8000

# Run migrations and start production server
CMD php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=8000
