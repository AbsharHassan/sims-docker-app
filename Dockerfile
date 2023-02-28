# Use the official PHP 8.0.2 image as the base
FROM php:8.1-fpm-alpine3.14

# Install necessary PHP extensions and other dependencies
RUN apk update && apk add \
    shadow \
    nodejs \
    npm \
    zip \
    unzip \
    git \
    && docker-php-ext-install \
    bcmath \
    pdo_mysql


COPY --from=composer:2.4 /usr/bin/composer /usr/bin/composer

RUN usermod -u 1000 www-data

RUN chown -R www-data:www-data /root/
RUN chmod -R 755 /root/

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# # Copy the current directory contents into the container at /var/www/html
COPY --chown=www-data:www-data . .

# Set permissions for user
RUN chown -R www-data:www-data /var/www/html

# RUN chmod -R 755 /var/www/html/storage/
# # RUN chmod -R 644 /var/www/html/storage/clockwork/*
# # RUN find /var/www/html/storage -type f -exec chmod 644 {} \;
# RUN chmod -R 755 /var/www/html/bootstrap/

RUN composer install --no-interaction --no-progress
RUN npm install 
# RUN npm run prod

RUN php artisan cache:clear
RUN php artisan config:clear


RUN chmod -R 755 /var/www/html/storage/
# RUN chmod -R 644 /var/www/html/storage/clockwork/*
# RUN find /var/www/html/storage -type f -exec chmod 644 {} \;
RUN chmod -R 755 /var/www/html/bootstrap/

# CMD [ "php-fpm" ]
# CMD [ "composer", "install", "&&", "npm", "install", "&&", "npm", "run", "prod", "&&", "php-fpm" ]

# RUN chmod +x Docker/entrypoint.sh
ENTRYPOINT ["sh", "Docker/app/entrypoint.sh"]
