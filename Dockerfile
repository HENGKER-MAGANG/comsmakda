FROM php:8.1-apache

# Install ekstensi mysqli
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Salin semua file ke direktori Apache
COPY . /var/www/html/

# Aktifkan mod_rewrite untuk .htaccess
RUN a2enmod rewrite

# Set permission (opsional tapi direkomendasikan)
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Port default Apache adalah 80 (otomatis expose)
EXPOSE 80