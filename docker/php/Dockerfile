FROM php:8.1-cli-buster

RUN docker-php-ext-install pdo_mysql

ENTRYPOINT ["php", "artisan", "serve", "--host=0.0.0.0"]
