#bin/bash

composer install
php artisan migrate
php artisan db:seed
php artisan storage:link