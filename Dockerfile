FROM php:8.2-alpine

RUN apk add font-terminus font-inconsolata font-dejavu font-noto font-noto-cjk font-awesome font-noto-extra

RUN apk add --no-cache \
    libzip-dev

RUN docker-php-ext-install mysqli pdo zip pdo_mysql && docker-php-ext-enable pdo_mysql zip

# Install necessary packages
RUN apk add --no-cache \
    composer \
    git \
    make \
    gcc \
    g++ \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    libxslt-dev \
    libxml2-dev \
    pcre2-dev \
    ca-certificates \
    openssh \
    libreoffice \
    php-zip \
    php-gd \
    php-xml \
    php-dom \
    php-tokenizer\
    php-session \
    php-fileinfo \
    php-simplexml \ 
    php-xmlwriter \
    php-xmlreader \
    imagemagick \
    npm

# Set workdir
WORKDIR /app

# Copy the rest of the project files
COPY . /app

# Install dependencies
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

# Migrate database
#RUN php artisan migrate

# Install npm packages
RUN npm install

# Build your frontend assets
RUN npm run build

# Expose port
EXPOSE 8000

# Start the development server
CMD php artisan serve --host=0.0.0.0