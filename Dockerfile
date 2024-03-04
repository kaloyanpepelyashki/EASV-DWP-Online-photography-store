# Use an official PHP runtime as a parent image
FROM php:8.0-apache

# Install PHP extensions and other dependencies
RUN apt-get update && \
    apt-get install -y libpng-dev && \
    docker-php-ext-install mysqli && \
    docker-php-ext-enable mysqli

RUN a2enmod rewrite

EXPOSE 80 443

# Set the working directory in the container
WORKDIR /var/www/html

# Copy your PHP application code into the container
COPY ./application .

# Start Apache when the container runs
CMD ["apache2-foreground"]
