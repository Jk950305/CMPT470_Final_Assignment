FROM php:7.2-apache-stretch
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN sed -s -i -e "s/80/8080/" /etc/apache2/ports.conf /etc/apache2/sites-available/*.conf
USER www-data
EXPOSE 8080
WORKDIR /app
COPY app/. /var/www/html/
USER root
RUN chown -R www-data:www-data /var/www