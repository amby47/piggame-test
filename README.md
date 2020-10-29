# Pig Game Project

## How to setup

### Pre-requisites
 - PHP
 - Laravel 8.8.0
 - MySQL Database
 - PHP Composer

### Setup
- Download the project into the folder and run the following commands within the folder:
 > `composer install`

 > `cp .env.example .env`
 
 > `php artisan key:generate`

 - Open .env file and enter your database details within the DB section. Once completed, run the following commands within the project folder
 
 > `php artisan migrate`

- The above command should create the database schema and tables.

- Run the application using the following command:
> `php artisan serve`

You should now be able to access the application at `http://localhost:8000`
