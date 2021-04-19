FROM php:7.4-fpm-alpine

RUN apk update \
    && apk --no-cache add nginx supervisor curl g++ make autoconf \
    php7 php7-fpm php7-mysqli php7-json php7-openssl php7-curl php7-zlib php7-xml \
    php7-phar php7-intl php7-dom php7-xmlreader php7-ctype php7-mbstring \
    php7-gd php7-imagick php7-redis php7-opcache php7-zip php7-pdo php7-pdo_mysql \
    php7-tokenizer php7-simplexml php7-xmlwriter php7-iconv  php7-fileinfo \
    && docker-php-source extract \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql \
    && docker-php-ext-install pdo_mysql \
    && docker-php-source delete \
    &&  rm -rf /tmp/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apk --update --no-cache add autoconf g++ make && \
    pecl install -f xdebug && \
    docker-php-ext-enable xdebug && \
    apk del --purge autoconf g++ make

COPY ./docker/webserver/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/webserver/nginx/default /etc/nginx/sites-enabled/default

COPY ./docker/webserver/php/fpm-pool.conf /etc/php7/php-fpm.d/www.conf
COPY ./docker/webserver/php/php.ini /etc/php7/conf.d/php.ini
COPY ./docker/webserver/php/xdebug.ini /etc/php7/conf.d/xdebug.ini

COPY ./docker/webserver/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

WORKDIR /var/www/

RUN chmod 777 -R *

#COPY . .

#RUN composer install

#RUN  /usr/local/bin/composer install
# RUN set -xe \
#     && composer install
#RUN composer install --no-interaction && \
#    composer dump-autoload --apcu

EXPOSE 8080 443

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:8080/fpm-ping