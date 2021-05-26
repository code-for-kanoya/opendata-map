#!/bin/sh

echo "extra parameter:" $@
php-cs-fixer fix --allow-risky=yes $@
