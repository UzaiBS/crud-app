#!/bin/bash
php-fpm &
nginx -c /home/site/nginx.conf -g "daemon off;"
