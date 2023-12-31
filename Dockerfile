FROM php:7.4-fpm

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install intl opcache pdo pdo_pgsql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip


WORKDIR /var/www/

COPY . ./

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN git config --global user.email "cherif.bouhelaghem@gmail.com" \
    && git config --global user.name "Cherif Bouchelaghem"
    
RUN docker-php-ext-install pdo pdo_mysql

RUN composer install