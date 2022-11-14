FROM php:8.1-apache

# Install PHP extensions
RUN apt-get update && apt-get upgrade -y
RUN apt-get install -y libzip-dev
RUN apt-get install -y libxml2-dev
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN docker-php-ext-install zip && docker-php-ext-enable zip
RUN docker-php-ext-install dom && docker-php-ext-enable dom
RUN a2enmod rewrite

# Change Apache document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/www

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy source
RUN if [ "$mode" = "prod" ] ; then echo "Production" ; else echo "Development" ; fi
RUN ls -la /var/www/html
COPY . /var/www/html
RUN chmod -R a+rw /var/www/html/temp /var/www/html/log

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Build application, install dependencies
RUN composer config --no-plugins allow-plugins.phpstan/extension-installer true
RUN composer install

# VOLUME /var/www/html # Overrides the /var/www/html. User must install dependencies manually. 
VOLUME /etc/apache2/sites-available
