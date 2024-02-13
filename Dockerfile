# Use PHP 8.2 with Apache as the base image
FROM php:8.2-apache

# Install OS packages for PHP extensions and other utilities
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libwebp-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    curl && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Configure PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp && \
    docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Enable Apache mod_rewrite for Laravel's .htaccess file
RUN a2enmod rewrite

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory to Apache's document root
WORKDIR /var/www/html

# Copy the application's code to the working directory
COPY . /var/www/html

# Use Composer to install PHP dependencies
# Consider adding --no-dev if you're building for production
RUN composer install --optimize-autoloader && \
    composer clear-cache

# Set permissions for Laravel storage and bootstrap cache directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80 to access the Apache server
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
