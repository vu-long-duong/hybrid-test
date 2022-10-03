FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl dirmngr apt-transport-https lsb-release ca-certificates


RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -

RUN apt-get install nodejs
# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
# RUN useradd -G www-data,root -u $uid -d /home/$user $user
# RUN mkdir -p /home/$user/.composer && \
#     chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www/laravel

FROM node:10

RUN apt-get update && \
  npm install -g firebase-tools

WORKDIR /app/functions

COPY package*.json ./

CMD npm install \
  && firebase use ${FIREBASE_PROJECT} --token ${FIREBASE_TOKEN} \
  && npm run emulators

EXPOSE 4000 5000 5001