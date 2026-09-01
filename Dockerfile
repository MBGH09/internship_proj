# ============================================================
# Stage 1 — Build frontend assets (Node.js + Vite + Tailwind)
# ============================================================
FROM node:22-alpine AS frontend

WORKDIR /app

# Copy package files and install dependencies
COPY package.json package-lock.json* ./
RUN npm ci --prefer-offline

# Copy source files needed for the build
COPY vite.config.js ./
COPY resources/ ./resources/

# Build production assets
RUN npm run build


# ============================================================
# Stage 2 — Install PHP dependencies (Composer)
# ============================================================
FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-scripts \
    --prefer-dist \
    --optimize-autoloader


# ============================================================
# Stage 3 — Final production image (PHP-FPM + Nginx)
# ============================================================
FROM php:8.2-fpm-alpine AS production

LABEL maintainer="event-planner"
LABEL description="Event Planner Laravel Application"

# ------------------------------------
# System dependencies & PHP extensions
# ------------------------------------
RUN apk add --no-cache \
        nginx \
        supervisor \
        curl \
        libpng-dev \
        libjpeg-turbo-dev \
        freetype-dev \
        libzip-dev \
        icu-dev \
        oniguruma-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl \
        opcache

# ------------------------------------
# PHP configuration — production tuning
# ------------------------------------
COPY docker/php/php.ini /usr/local/etc/php/conf.d/app.ini
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# ------------------------------------
# Nginx configuration
# ------------------------------------
COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/default.conf /etc/nginx/http.d/default.conf

# ------------------------------------
# Supervisor configuration (manages nginx + php-fpm)
# ------------------------------------
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# ------------------------------------
# Application code
# ------------------------------------
WORKDIR /var/www/html

# Copy vendor from composer stage
COPY --from=vendor /app/vendor ./vendor

# Copy built frontend assets from frontend stage
COPY --from=frontend /app/public/build ./public/build

# Copy the rest of the application
COPY . .

# ------------------------------------
# Storage & permissions
# ------------------------------------
RUN mkdir -p storage/framework/{sessions,views,cache} \
             storage/logs \
             bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# ------------------------------------
# Entrypoint script
# ------------------------------------
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
