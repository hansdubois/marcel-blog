FROM php:7.0-fpm

RUN apt-get update --fix-missing \
    && pecl channel-update pecl.php.net \
    && pecl install xdebug \
    && apt-get install -y libpq-dev \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install -j$(nproc) pdo_mysql gettext sockets

RUN apt-get install -y locales \
    && echo "fr_BE UTF-8" >> /etc/locale.gen \
    && locale-gen fr_BE.UTF-8

COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
