# Offical Docker Image for PHP
# https://hub.docker.com/_/php
FROM php:7.4-apache

# Set Current Directory
WORKDIR /var/www/html/

# Install dependencies
RUN apt-get clean && apt-get update && apt-get upgrade -y && apt-get install -y \
    net-tools \
	rsync \
    git \
	nodejs \
	npm \
	git \
	zip \
	curl \
	sudo \
	nano \
    unzip \
    zip \
	libpq-dev \
	mlocate \
	g++ \
    libgd-dev \
    libonig-dev \
    libmagickwand-dev \
    libxml2-dev \
    libzip-dev \
	libicu-dev \
	libbz2-dev \
	libpng-dev \
	libmcrypt-dev \
	libreadline-dev \
	libfreetype6-dev \
	libjpeg62-turbo-dev \
	libwebp-dev \
	mariadb-client

RUN docker-php-source extract && \
    pecl install xdebug && \
    pecl install imagick && \
    docker-php-ext-enable xdebug && \
    docker-php-ext-enable imagick && \
    docker-php-source delete

RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-webp=/usr/include/ --with-jpeg=/usr/include/

# PHP Extensions
RUN docker-php-ext-install \
    soap \
    pcntl \
    intl \
    bcmath \
    ctype \
    json \
    gd \
    mbstring \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    fileinfo \
    tokenizer \
    exif \
    xml \
	zip

# Update Node
RUN npm install -g n
RUN npm install npm@latest -g
RUN n stable

# Install Composer from Official Docker Image
# https://hub.docker.com/_/composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Apache Server Name
RUN echo "ServerName host.docker.internal" | sudo tee /etc/apache2/conf-available/servername.conf
RUN sudo a2enconf servername

# Mod Rewrite
RUN a2enmod rewrite
