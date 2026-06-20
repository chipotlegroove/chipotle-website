#Build frontend assets
FROM oven/bun:1 AS node-builder
WORKDIR /app
COPY package.json bun.lock* ./
RUN bun install --frozen-lockfile
COPY . .
RUN bun run build

#PHP App
FROM serversideup/php:8.5-frankenphp

#Use root to install dependencies and copy files
USER root

RUN install-php-extensions \
    pdo_pgsql \
    pgsql \
    intl \
    zip \
    bcmath \
    exif

COPY --chown=www-data:www-data . /var/www/html
COPY --chown=www-data:www-data --from=node-builder /app/public/build /var/www/html/public/build

USER www-data
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader --no-interaction
