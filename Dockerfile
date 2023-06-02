FROM php:7.2.5-apache

RUN docker-php-ext-install mysqli

# USER root

RUN apt-get update && apt-get install -y libmagickwand-dev --no-install-recommends && rm -rf /var/lib/apt/lists/*
RUN printf "\n" | pecl install imagick
RUN docker-php-ext-enable imagick

# Install GD
RUN apt update \
    && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) intl pdo_mysql bcmath mbstring exif gd

#COPY --from=bxu58381.live.dynatrace.com/linux/oneagent-codemodules:all / /
#ENV LD_PRELOAD /opt/dynatrace/oneagent/agent/lib64/liboneagentproc.so

COPY ./ /var/www/html
ADD apache-config.conf /etc/apache2/sites-enabled/000-default.conf
ADD apache2.conf /etc/apache2/apache2.conf
ADD php.ini /usr/local/etc/php/php.ini
ADD php-errors.log /var/log/snapPlus/php-errors.log

RUN chmod -R 777 /var/log/snapPlus
RUN chmod -R 777 /var/www/html

RUN mkdir -p /var/www/html/upload
RUN chmod 777 /var/www/html/upload
RUN chown -R www-data:www-data /var/www/html/upload

EXPOSE 80

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
