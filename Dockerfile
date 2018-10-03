FROM php:7.1.2-apache 
RUN docker-php-ext-install mysqli
RUN pecl install xdebug

# Copy php.ini into image
ADD config/php.ini /usr/local/etc/php/