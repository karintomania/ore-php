FROM php:8.1-apache
RUN apt-get -y update \
&& apt-get install -y \
	 	zip unzip \
&& pecl install xdebug

RUN docker-php-ext-install pdo_mysql

RUN a2enmod rewrite

