########################################################################################
# コンテナイメージ作成スクリプト
########################################################################################
REPOSITOTY:=
IMAGE:=code4kanoya/opendata_map
TAG:=latest
VERSION:=7.4-fpm
NODE_VERSION:="14.17.0"
BASE_IMAGE:=$(IMAGE)-base
BASE_IMAGE_TAG:=$(TAG)
PLATFORMS:=linux/amd64

all: build-base build-production

build-base:
	docker buildx build \
	--platform $(PLATFORMS) \
	--push \
	-t $(REPOSITOTY)$(BASE_IMAGE):$(BASE_IMAGE_TAG) \
	-f ../.devcontainer/container-context-opendata-map/build/php/Dockerfile \
	--target app_base \
	--build-arg VERSION=$(VERSION) \
	--build-arg NODE_VERSION=$(NODE_VERSION) \
	../.devcontainer/container-context-opendata-map/build/php

build-production:
	docker buildx build \
	--platform $(PLATFORMS) \
	--push \
	-t $(REPOSITOTY)$(IMAGE):$(TAG) \
	--build-arg REPOSITOTY=$(REPOSITOTY) \
	--build-arg BASE_IMAGE=$(BASE_IMAGE) \
	--build-arg BASE_IMAGE_TAG=$(BASE_IMAGE_TAG) \
	-f ./Dockerfile \
	../laravel
