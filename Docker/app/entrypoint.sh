#!/bin/sh

echo "entered entrypoint file"

npm run prod

php artisan migrate

chown -R www-data:www-data storage/
chown -R www-data:www-data bootstrap/
su -s /bin/sh www-data

chmod -R 755 storage/
chmod -R 755 bootstrap/

echo "all processes done. Running PHP-FPM"

php-fpm