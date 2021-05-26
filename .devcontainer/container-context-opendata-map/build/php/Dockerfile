ARG VERSION=latest
FROM php:${VERSION} AS app_base
ARG NODE_VERSION=latest

# install native packages(for php) and supervisor, cron, composer
RUN apt-get update \
    && apt-get install -y git libzip-dev libonig-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    supervisor \
    cron \
    wget unzip zip tar

# install & enabled php packages
RUN pecl install zip redis \
    && docker-php-ext-enable zip redis \
    && docker-php-ext-install pdo_mysql mbstring pcntl gd

# php configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && sed -i.bak -e "s/post_max_size = [0-9]*[kmgKMG]/post_max_size = 300M/" "$PHP_INI_DIR/php.ini" \
    && sed -i.bak -e "s/upload_max_filesize = [0-9]*[kmgKMG]/upload_max_filesize = 600M/" "$PHP_INI_DIR/php.ini" \
    && sed -i.bak -e "s/memory_limit = [0-9]*[kmgKMG]/memory_limit = 1000M/" "$PHP_INI_DIR/php.ini"

# supervisor setup
RUN mkdir -p /var/log/horizon && \
    chown www-data:www-data /var/log/horizon && \
    touch /var/log/horizon/horizon.log
COPY supervisor/horizon.conf /etc/supervisor/conf.d/horizon.conf
RUN service supervisor start

# cron setup
RUN echo '* * * * * cd /var/www && /usr/local/bin/php artisan schedule:run >> /dev/null 2>&1' | crontab

# composer install & setup
COPY composer/installer.sh /tmp/installer.sh
RUN chmod 700 /tmp/installer.sh && \
    /tmp/installer.sh && \
    rm -f /tmp/installer.sh && \
    composer global require friendsofphp/php-cs-fixer
ENV PATH=${PATH}:/root/.composer/vendor/bin

# nodejs install & setup
COPY get-architecture.sh /tmp/get-architecture.sh
RUN chmod 700 /tmp/get-architecture.sh && \
    export ARCH=$(/tmp/get-architecture.sh) && \
    cd /usr/local && \
    wget -O node-v${NODE_VERSION}-linux.tar.xz https://nodejs.org/dist/v${NODE_VERSION}/node-v${NODE_VERSION}-linux-${ARCH}.tar.xz
RUN cd /usr/local && \
    tar Jxvf node-v${NODE_VERSION}-linux.tar.xz --strip-components 1 && \
    chmod 755 /usr/local/bin/node
RUN cd /usr/local && \
    rm -f node-v${NODE_VERSION}-linux.tar.xz

# apt cache clean
RUN apt-get clean

FROM app_base AS app_test

# install & enabled php packages
RUN pecl install xdebug-2.9.6 \
    && docker-php-ext-enable xdebug

# php configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" \
    && sed -i.bak -e "s/post_max_size = [0-9]*[kmgKMG]/post_max_size = 300M/" "$PHP_INI_DIR/php.ini" \
    && sed -i.bak -e "s/upload_max_filesize = [0-9]*[kmgKMG]/upload_max_filesize = 600M/" "$PHP_INI_DIR/php.ini" \
    && sed -i.bak -e "s/memory_limit = [0-9]*[kmgKMG]/memory_limit = 1000M/" "$PHP_INI_DIR/php.ini"
