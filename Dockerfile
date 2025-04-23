# use PHP 8.2
FROM php:8.2-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

#clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install common php extension dependencies
RUN apt-get update && apt-get install -y \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    zlib1g-dev \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    zip \
    git \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install zip \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install bcmath

RUN docker-php-ext-enable intl mbstring zip bcmath

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set the working directory
COPY ./src /var/www/app
WORKDIR /var/www/app

RUN chown -R www-data:www-data /var/www/app \
    && chown -R www-data:www-data /var/www/app/storage \
    && chown -R www-data:www-data /var/www/app/bootstrap/cache \
    && chmod -R 775 /var/www/app/storage \
    && chmod -R 775 /var/www/app/bootstrap/cache

# copy composer.json to workdir & install dependencies
# COPY composer.json ./
# RUN composer install

USER $user

# Set the default command to run php-fpm
CMD ["php-fpm"]