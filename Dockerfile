# Dockerfile
FROM php:8.1-apache

# Install mysqli untuk koneksi ke MySQL
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Salin file project ke dalam container
COPY ./src/ /var/www/html/

# Aktifkan mod_rewrite (jika pakai .htaccess)
RUN a2enmod rewrite

# Set folder hak akses
RUN chown -R www-data:www-data /var/www/html
