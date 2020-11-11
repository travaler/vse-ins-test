FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
    libfreetype6-dev libjpeg62-turbo-dev libicu-dev libzip-dev libpng-dev zlib1g-dev \
    wget unzip git \
        --no-install-recommends

RUN docker-php-ext-install zip intl pdo_mysql

RUN pecl install -o -f xdebug \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable xdebug

COPY ./php.ini /usr/local/etc/php/
COPY ./www.conf /usr/local/etc/php-fpm.d/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

RUN apt-get purge -y g++ \
    && apt-get autoremove -y \
    && rm -r /var/lib/apt/lists/* \
    && rm -rf /tmp/*

RUN usermod -u 1000 www-data

VOLUME /root/.composer
WORKDIR /app

EXPOSE 9000
CMD ["php-fpm"]
