#!/bin/sh

march=$(uname -m)

case "${march}" in
  "aarch64"|"arm64")
    ARCH=arm64
    ;;
  *)
    ARCH=x64
    ;;
esac

echo ${ARCH}
