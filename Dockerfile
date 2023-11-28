# Use an official PHP image as the base image
FROM php:7.4-apache

# Install MySQLi extension
RUN docker-php-ext-install mysqli

# Install GD extension
RUN apt-get update && \
    apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
    docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
    docker-php-ext-install -j$(nproc) gd

# Copy custom php.ini file
COPY ./php.ini /usr/local/etc/php/php.ini
