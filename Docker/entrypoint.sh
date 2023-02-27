#!/bin/sh

echo "entered entrypoint file"

chown -R www-data:www-data storage/
chown -R www-data:www-data bootstrap/
su -s /bin/sh www-data

chmod -R 755 storage/
chmod -R 755 bootstrap/

npm run prod

echo "all processes done. Running PHP-FPM"

php-fpm
