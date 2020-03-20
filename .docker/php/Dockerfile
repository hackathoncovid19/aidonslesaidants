FROM php:7.3.5-fpm

ADD ini /usr/conf/php/ini

# Fallback repositories not working on .docker ubuntu version
RUN printf "deb http://archive.debian.org/debian/ jessie main\ndeb-src http://archive.debian.org/debian/ jessie main\ndeb http://security.debian.org jessie/updates main\ndeb-src http://security.debian.org jessie/updates main" > /etc/apt/sources.list

# Installing extensions
RUN set -ex; \
	\
	apt-get update; \
	apt-get install -y \
        libmcrypt-dev \
        zip unzip \
        ssmtp; \
	\
	rm -rf /var/lib/apt/lists/*; \
	\
	docker-php-ext-install mysqli opcache pdo_mysql json; \
    pecl install -o -f xdebug mcrypt \
    && rm -rf /tmp/pear;

# Appending configuration to respective files
RUN \
	# PHP ini
	cat /usr/conf/php/ini/php.ini > /usr/local/etc/php/php.ini; \
	# OpCache
	cat /usr/conf/php/ini/opcache.ini > /usr/local/etc/php/conf.d/opcache-recommended.ini; \
	# Xdebug
	cat /usr/conf/php/ini/xdebug.ini > /usr/local/etc/php/conf.d/xdebug.ini;

# Composer installation
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"; \
	php composer-setup.php; \
	php -r "unlink('composer-setup.php');" \
	mv /var/www/html/composer.phar .; 

CMD ["php-fpm"]
EXPOSE 9000