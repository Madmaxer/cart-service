FROM php:7.3-fpm-alpine AS base
RUN apk add --update --no-cache --virtual htop \
    nmap \
    nmap-nping \
    tcpdump \
    strace \
    lsof \
    wget \
    zip \
    gnupg \
    mysql-client \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install soap

FROM base AS builder
RUN apk add --update --no-cache --virtual .build-deps curl
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
USER www-data
WORKDIR /var/www/html
COPY composer.json composer.json
COPY composer.lock composer.lock
RUN composer global require hirak/prestissimo --no-plugins --no-scripts
RUN composer install --prefer-dist --no-scripts --no-autoloader
COPY --chown=www-data:www-data . .
RUN composer dump-autoload --no-scripts --optimize

FROM base
USER root
COPY --chown=www-data:www-data --from=builder /var/www/html .
COPY ./deployment/config/ci/app/ /etc/config/keys
WORKDIR /var/www/html
