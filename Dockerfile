FROM php:8.1-apache

# Install PHP extensions
RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y libzip-dev
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN docker-php-ext-install zip && docker-php-ext-enable zip

# Change Apache document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/www

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy source
COPY . /var/www/html
RUN chmod -R a+rw /var/www/html/temp /var/www/html/log

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Build application, install dependencies
RUN composer config --no-plugins allow-plugins.phpstan/extension-installer true
RUN composer install
