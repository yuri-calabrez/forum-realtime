FROM php:7.1-fpm

RUN apt-get update && apt-get install -y \
        vim \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        zlib1g-dev libicu-dev g++ \
    && docker-php-ext-install -j$(nproc) mcrypt \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl
	
RUN docker-php-ext-install mysqli pdo pdo_mysql zip exif
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

RUN usermod -u 1000 www-data

EXPOSE 9000
CMD ["php-fpm"]
