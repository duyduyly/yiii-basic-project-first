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

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --no-scripts

COPY . .

# Allow .htaccess under app public roots.
RUN printf '\n<Directory /var/www/html/apps>\n    Options Indexes FollowSymLinks\n    AllowOverride All\n    Require all granted\n</Directory>\n' > /etc/apache2/conf-available/app-roots.conf \
 && a2enconf app-roots

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

RUN apt-get update && apt-get install -y dos2unix \
 && dos2unix /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh \
 && chown -R www-data:www-data /var/www/html

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]
