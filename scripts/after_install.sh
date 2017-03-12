#!/bin/bash
php /var/www/html/artisan clear-compiled
php /var/www/html/artisan optimize
php /var/www/html/artisan view:clear
php /var/www/html/artisan cache:clear

sudo chown -R ec2-user:www-data /var/www/html
sudo find /var/www/html -type d -exec chmod 755 {} +
sudo find /var/www/html -type f -exec chmod 644 {} +
sudo chmod -R 777 /var/www/html/storage
sudo chmod -R 777 /var/www/html/.env

composer update -d /var/www/html