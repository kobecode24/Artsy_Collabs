# Use the official PHP image with Apache
FROM php:8.2-apache

# Install system dependencies for PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd zip exif pcntl bcmath

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the application code to the container
COPY . .

# Install PHP dependencies with Composer
# Skip the scripts that require .env or application key during the build
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Correct permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Start Apache server in the foreground
CMD ["apache2-foreground"]
