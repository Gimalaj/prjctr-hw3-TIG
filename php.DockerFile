FROM php:7.4-fpm

RUN apt install pkg-config -y
RUN pecl install mongodb
#RUN docker-php-ext-install zip

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer self-update

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

RUN echo "extension=mongodb.so" > $PHP_INI_DIR/conf.d/mongo.ini
RUN echo "pm.status_path = /status" >> /usr/local/etc/php-fpm.d/www.conf

