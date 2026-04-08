#!/usr/bin/env bash
mkdir -p /var/www/html/storage/data
touch /var/www/html/storage/data/database.sqlite
chown -R www-data:www-data /var/www/html/storage/data
/usr/bin/php /var/www/html/artisan migrate --force
