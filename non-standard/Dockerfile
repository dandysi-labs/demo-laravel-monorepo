FROM composer:2.2 as build
COPY . /app/
RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction --working-dir laravel

FROM php:8.2-buster as production

RUN apt-get update && \
    apt-get install --no-install-recommends -y \
    libssl-dev \
    libsasl2-dev \
    curl \
    libzip-dev \
    gnupg \
    unixodbc-dev \
    libmcrypt-dev \
    libpq-dev

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    zip \
    bcmath \
    opcache \
    sockets \
    pcntl

RUN mkdir -p /var/www/storage/logs

ENV PHP_OPCACHE_ENABLE="1" \
    PHP_OPCACHE_VALIDATE_TIMESTAMPS="0" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="32531" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="256" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10" \
    PHP_OPCACHE_INTERNED_STRINGS_BUFFER="64" \
    PHP_OPCACHE_JIT_BUFFER_SIZE="100M"

RUN echo 'memory_limit = 1024M' >> /usr/local/etc/php/conf.d/docker-php-memory_limit.ini && \
    echo 'max_execution_time = 300' >> /usr/local/etc/php/conf.d/docker-php-max_execution_time.ini && \
    echo 'expose_php = off' >> /usr/local/etc/php/conf.d/docker-php-disable_expose_php.ini

COPY ./docker/start.sh /usr/local/bin/start

RUN chmod +x /usr/local/bin/start

COPY --from=build /app /var/www

RUN chown -R www-data:www-data /var/www/laravel

WORKDIR /var/www/laravel

ENTRYPOINT ["/usr/local/bin/start"]

EXPOSE 8000

CMD ["web"]
