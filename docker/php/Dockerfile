FROM php:8.1-fpm

#Set working directory
WORKDIR /var/www/project/api

#Install dependecies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libpq-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    postgresql \
    postgresql-client \
    default-mysql-client \
    make \
    wget \
    mc \
    cron \
    supervisor

#Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

#Install Extensions
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo pdo_pgsql pgsql pdo_mysql zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd

#Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000

ENTRYPOINT ["/bin/sh", "-c" , "/usr/bin/supervisord && php-fpm"]
