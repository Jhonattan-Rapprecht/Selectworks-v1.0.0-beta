FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libzip-dev

RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

RUN a2enmod rewrite

# Set document root
ENV APACHE_DOCUMENT_ROOT=/var/www

# Overwrite Apache vhost config
RUN printf "<VirtualHost *:80>\n\
    DocumentRoot /var/www\n\
    <Directory /var/www>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>\n" > /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www
