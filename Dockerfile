FROM php:8.2-apache AS build-php

RUN --mount=type=cache,target=/var/cache/apt apt update && apt full-upgrade -qy && apt clean -qy && apt autoremove -qy
RUN mount=type=cache,target='/usr/local/lib/php' \
    pecl install xdebug \
    && docker-php-ext-enable xdebug
RUN docker-php-ext-install mysqli pdo_mysql && docker-php-ext-enable mysqli pdo_mysql


RUN groupadd -g 1000 myusergroup \
    && useradd -u 1000 -g myusergroup -m myuser

RUN chown -R myuser:myusergroup /var/www \
    && chmod -R 755 /var/www

RUN chown -R myuser:myusergroup /etc/apache2 \
    && chmod -R 755 /etc/apache2


RUN chown -R myuser:myusergroup /var/lib/apache2 \
    && chmod -R 755 /var/lib/apache2

USER myuser
USER root

CMD ["apache2-foreground"]