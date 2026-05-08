FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl zip nodejs npm \
    libpng-dev libonig-dev libxml2-dev

RUN docker-php-ext-install pdo pdo_mysql mbstring bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN npm install
RUN npm run build

RUN chmod -R 775 storage bootstrap/cache

RUN php artisan config:clear
RUN php artisan cache:clear

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000
