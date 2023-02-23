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

RUN usermod -u 1000 www-data

# Set permissions for user
RUN chown -R www-data:www-data /var/www/html

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY --chown=www-data:www-data ./ ./

RUN chmod -R 755 /var/www/html/storage
RUN chmod -R 755 /var/www/html/bootstrap

COPY --from=composer:2.4 /usr/bin/composer /usr/bin/composer

# # Install Nodejs
# RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - && \
#     apk update && apk add nodejs

# Install Composer
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# RUN chmod -R 755 /storage
# RUN chmod -R 755 /bootstrap

# Install npm dependencies
# RUN npm install

# # Create Vue.js prod build
# # RUN chown -R 33:33 "/root/.npm"
# RUN npm run prod

# Install Composer dependencies
# RUN composer install 


# # Start the PHP built-in web server
# CMD ["tail", "-f", "/dev/null"]
CMD [ "php-fpm" ]
