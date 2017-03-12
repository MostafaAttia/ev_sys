#!/bin/bash
php /var/www/html/artisan clear-compiled
php /var/www/html/artisan optimize
php /var/www/html/artisan view:clear
php /var/www/html/artisan cache:clear

sudo chown -R ec2-user:www /var/www/html
sudo find /var/www/html -type d -exec sudo chmod 775 {} +
sudo find /var/www/html -type f -exec sudo chmod 644 {} +
sudo chmod -R 777 /var/www/html/storage
sudo chmod -R 777 /var/www/html/bootstrap
sudo chmod -R 777 /var/www/html/.env

composer install -d /var/www/html