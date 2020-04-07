# Set master image
FROM php:7.2-fpm-alpine

# Install Additional dependencies
RUN apk update && apk add \
  git \
  wget \
  freetype \
  freetype-dev \
  libpng-dev \
  jpeg-dev \
  libzip-dev \
  zip \
  unzip \
  openssh

RUN docker-php-ext-configure gd \
  --with-freetype-dir=/usr/bin/ \
  --with-png-dir=/usr/bin/ \
  --with-jpeg-dir=/usr/lib/ \
  --with-gd

RUN docker-php-ext-install gd opcache pdo_mysql && \
  docker-php-ext-configure zip --with-libzip && \
  docker-php-ext-install zip

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Remove Cache
RUN rm -rf /var/cache/apk/*

# Add UID '1000' to www-data
RUN apk --no-cache add shadow && usermod -u 1000 www-data

# Chang app directory permission
RUN chown -R www-data:www-data .