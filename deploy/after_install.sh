# deploy/after_install
#!/bin/bash
cd /var/www/html/
composer install
sudo service apache2 restart