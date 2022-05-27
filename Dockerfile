# syntax=docker/dockerfile:1.3-labs
FROM php:8.0

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN <<eot
apt update
apt install -y git unzip
rm -rf /var/lib/apt/lists/*
docker-php-ext-install mysqli pdo pdo_mysql
eot
