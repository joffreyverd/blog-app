# Blog App

A modern monolitic blog app built with Laravel 11 and Vue.js 3.

## Stack
- Laravel 11 / PHP 8.2
- Vue.js 3 (composition API)
- Inertia
- Breeze (auth)
- Tailwind

## Features
- Auth (register & login) using Breeze
- List & read articles
- Update & delete articles (only yours)
- Upload photo on articles
- Link articles to a category
- Pagination & infinite scrolling using Inertia & Vue Observer API

## Run app
```sh
# clone the project and get the right env variables
git clone ...
cd blog-app
cp .env.example .env

# install dependencies
composer install
npm install

# connect public/storage to storage/app/public
php artisan storage:link

# create a new database
docker run --rm --name blog_db -e POSTGRES_USER=root -e POSTGRES_PASSWORD=X8iBgconx78qUrUp -p 5432:5432 -d postgres

# execute migrations
php artisan migrate

# seed the database
php artisan db:seed

# run server
php artisan serve
```

## Dev cheatsheet
```sh
# project initialization
laravel new blog-app

# create models with migration
php artisan make:model Category -m
php artisan make:model Article -m

# create controllers
php artisan make:controller Api/CategoryController --api --resource --model=Category
php artisan make:controller Api/ArticleController --api --resource --model=Article

# create request
php artisan make:request ArticleRequest
# create resource
php artisan make:resource ArticleResource

# create seeder
php artisan make:seeder CategoryTableSeeder

# lint with Pint
./vendor/bin/pint
```
