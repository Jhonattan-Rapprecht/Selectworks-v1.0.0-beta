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

RUN docker-php-ext-install pdo pdo_mysql mysqli mbstring zip exif pcntl bcmath gd

RUN docker-php-ext-install mysqli

RUN a2enmod rewrite

# Create vscode user for Codespaces
RUN useradd -ms /bin/bash vscode \
    && echo "vscode ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers

ENV APACHE_DOCUMENT_ROOT=/var/www

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

RUN printf "<VirtualHost *:80>\n\
    DocumentRoot ${APACHE_DOCUMENT_ROOT}\n\
    <Directory ${APACHE_DOCUMENT_ROOT}>\n\
    AllowOverride All\n\
    Options Indexes FollowSymLinks\n\
    Require all granted\n\
    </Directory>\n\
    </VirtualHost>\n" > /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www
