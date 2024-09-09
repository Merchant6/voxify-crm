FROM php:8.2-apache

# Install necessary packages
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxslt1-dev \
    libxml2-dev \
    pcre2-utils \
    git \
    gcc \
    g++ \
    make \
    ca-certificates \
    openssh-client \
    imagemagick \
    libreoffice \
    npm \
    nano

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli pdo zip pdo_mysql xsl

# Enable Apache modules
RUN a2enmod rewrite headers

# Set Apache to listen on port 8080
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf \
    && sed -i 's/:80>/:8080>/' /etc/apache2/sites-available/000-default.conf

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set workdir
WORKDIR /app

# Copy the rest of the project files
COPY . /app

# Install PHP dependencies
RUN composer install

# Copy .env.example to .env
COPY .env.example .env

# Set environment variables
ENV APP_ENV local
ENV APP_DEBUG false
ENV DB_CONNECTION mysql
ENV DB_HOST 127.0.0.1
ENV DB_PORT 3306

# Generate app key
RUN php artisan key:generate

# Link public to storage
RUN php artisan storage:link

# Install npm packages
RUN npm install

# Build frontend assets
RUN npm run build

# Expose port 8080
EXPOSE 8080

# Start Apache server
CMD ["apache2-foreground"]
