FROM php:8.2-apache

RUN apt-get update && apt-get install -y 
    
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


RUN usermod -u 1000 www-data

RUN a2enmod rewrite