FROM php:8.4-apache


RUN a2enmod rewrite

# install extension
RUN apt-get update \
 && apt-get install -y --no-install-recommends \
    libicu-dev \
    libzip-dev \
    libonig-dev \
    unzip \
    git \
 && docker-php-ext-install intl pdo pdo_mysql zip mbstring \
 && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php \
 && mv composer.phar /usr/local/bin/composer \
 && chmod +x /usr/local/bin/composer

# Apache config
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/web|g' /etc/apache2/sites-available/000-default.conf

RUN printf '\n\
<Directory /var/www/html/web>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n\
' >> /etc/apache2/apache2.conf

WORKDIR /var/www/html

COPY composer.json composer.lock ./

RUN composer install --no-interaction --prefer-dist

COPY . .

RUN chown -R www-data:www-data /var/www/html