FROM php:8.2-apache

# Устанавливаем необходимые зависимости и расширения PHP
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    libgd-dev \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install zip gd

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копируем файлы проекта
WORKDIR /var/www/html
COPY . .

# Устанавливаем зависимости Composer
RUN composer install

# Даём права на запись в папку output
RUN mkdir -p output && chown -R www-data:www-data output

# Включаем модуль rewrite для Apache (если нужно)
RUN a2enmod rewrite

# Указываем, что папка output монтируется как том
VOLUME /var/www/html/output