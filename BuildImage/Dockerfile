ARG REPOSITOTY=
ARG BASE_IMAGE=
ARG BASE_IMAGE_TAG=
FROM ${REPOSITOTY}${BASE_IMAGE}:${BASE_IMAGE_TAG}

COPY . /var/workspace

WORKDIR /var/workspace

RUN composer install \
    && npm install \
    && npm run prod

RUN chown www-data:www-data -Rf \
    storage/app \
    storage/framework \
    storage/logs
