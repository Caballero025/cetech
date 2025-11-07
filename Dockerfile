# Stage 1: build
FROM php:8.2-fpm-alpine
WORKDIR /var/www/html

# Extensiones necesarias
RUN apk add --no-cache \
        bash \
        git \
        unzip \
        libzip-dev \
        oniguruma-dev \
        postgresql-dev \
        postgresql-client \
        curl \
        redis \
        autoconf \
        build-base

# Instalar extensiones PHP
RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql mbstring zip
RUN pecl install redis && docker-php-ext-enable redis

# Copiar proyecto
COPY . .

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Permisos de Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Copiar entrypoint (CRÍTICO)
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 9000

# SOLO ENTRYPOINT - NO CMD
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]