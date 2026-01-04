FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli pdo pdo_mysql zip

# Enable Apache modules
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www

# Copy your application code
COPY ../../src/ /var/www/

# Set permissions
RUN chown -R www-data:www-data /var/www

# Expose port 80
EXPOSE 80
