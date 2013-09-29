# Every Equity

## Overview
This is a snapshot of the early stages of development of one of my personal projects, 
before anything proprietary was added. I believe it is a good demonstration of my ability 
to work easily with an advanced modern PHP framework, as well as many other libraries, while 
adding my own touch.

## Technical Overview
This app is built using my favorite framework, Laravel 4. It contains a lot of packages as well, 
which may be viewed in the composer.json file. Styling is done with Twitter Bootstrap v3. There are 
also a few Ruby Gems included as well that I use for TDD. 

## Requirements
*   Create a virtual host named everyequity.local (if you want to trigger the local environement)
*   $ composer install
*   Modify app/config/database.php file with your database credentials
*   Create a new database called *everyequity*
*   $ php artisan migrate --seed

## Notable Paths
*   public - This directory contains the public assets
    +   public/js/main.js
*   app - This directory contains just about everything else
    +   app/routes.php - All application routes
    +   app/controllers
    +   app/models
    +   app/views
    +   app/tests
    +   app/lib - The EveryEquity namespace
    +   app/services
    +   app/config/packages - customized package config files
    +   app/database - Migrations and Seeds