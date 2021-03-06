#!/bin/sh

apt-get update -y
apt-get install -y --no-install-recommends \
    git \
    libzip-dev \
    unzip \
    zip
apt-get clean -y

docker-php-ext-configure zip --with-libzip
docker-php-ext-install -j$(nproc) \
    zip

exit 0
