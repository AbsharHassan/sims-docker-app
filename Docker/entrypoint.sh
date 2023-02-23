#!/bin/sh

echo "entered entrypoint file"

if [ ! -f "vendor/autoload.php" ]; then
    echo "will install composer dependancies"
    composer install --no-progress --no-interaction
else
    echo "dependacnies already installed, will update"
    composer update --no-progress --no-interaction     
fi

# if [ ! -d "node_modules" ]; then
#     echo "will install npm stuff"
#     npm install --no-progress --no-interaction
# else
#     echo "no need to install npm stuff, will update"
#     npm update --no-progress --no-interaction
# fi
npm install

npm run prod

php-fpm
