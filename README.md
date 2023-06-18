# Minimum Requirement
 - PHP 7.4.x
 - Laravel 8.x

## Installation Guide

Enter to your webroot folder and run 
 - composer install
 - composer require apereo/phpcas:1.3.8

### Create new database

Create your database

### Environment Configuration
 - cp .env.example .env
 - php artisan key:generate
 - Edit .env file and change database configuration username, password and database name

## Artisan Migration

 - php artisan migrate --seed

## Dump autoload
 - composer dump-autoload

### Default user

Username : admin1@polyhack2023.com
Password : abcd1234

Username : admin2@polyhack2023.com
Password : abcd1234

Username : user1@polyhack2023.com
Password : abcd1234

Username : user2@polyhack2023.com
Password : abcd1234