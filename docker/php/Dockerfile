FROM php:7.4-apache

WORKDIR /var/www/

ENV APACHE_DOCUMENT_ROOT /var/www/public

RUN a2enmod rewrite

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" &&\
    php composer-setup.php &&\
    php -r "unlink('composer-setup.php');"

RUN apt-get update &&\
    apt-get install -y libpq-dev

RUN docker-php-ext-install pgsql pdo pdo_pgsql