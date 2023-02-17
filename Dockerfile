FROM php:8.0-apache
WORKDIR /var/www/html
RUN apt-get update -y
RUN docker-php-ext-install mysqli
CMD ["php" , "./setupDb.php"]
CMD ["php" , "./setupTable.php"]