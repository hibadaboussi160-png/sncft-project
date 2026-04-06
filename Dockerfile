FROM php:8.2-cli
WORKDIR /app
COPY . .
RUN apt-get update && apt-get install -y git curl zip unzip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer update --ignore-platform-reqs --no-audit --no-scripts
EXPOSE 8080
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
