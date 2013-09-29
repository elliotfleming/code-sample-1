# Every Equity

## To Do
* [X] Move **users** resource to **admin/users**
* [ ] Modify previously generated UsersTest.php to reflect new route @ **admin/users**
* [ ] Modify the current **users** resource to be a normal controller instead

## Commands to Run After Pulling
*   composer self-update (if installed globally)
*   composer update
*   php artisan migrate:refresh --seed

## Packages
*   [PHPUnit](https://github.com/sebastianbergmann/phpunit/)
    +   A unit testing framework
    +   Note: This package can be used if the environment doesn't already have PHPUnit installed
*   [Profiler](https://github.com/juy/profiler)
    +   A profiler toolbar package (similar to the one that came with previous versions of Laravel)
*   [Generators](https://github.com/JeffreyWay/Laravel-4-Generators)
    +   A package that adds artisan generators to speed up development 
*   [Authority](https://github.com/machuga/authority-l4)
    +   An simple authorization package that supplements Laravel's authentication system
*   [Notification](https://github.com/edvinaskrucas/notification)
    +   A simple notification management package
*   [Mockery](https://github.com/padraic/mockery)
    +   A simple mock objects framework that works with PHPUnit
*   [Sentry](https://github.com/cartalyst/sentry)
    +   **Currently Unused**
    +   A complex authentication and authorization package
*   [Ardent](http://laravelbook.github.com/ardent)
    +   **Currently Unused**
    +   A package that makes for easy validation, upon saving the model
    +   UPDATE: Using Ardent will throw errors if the model is used during DB seeding
        -   Modified DB seeds -> no longer using Eloquent
        -   Not using Ardent for now; will reconsider in the future
*   [FactoryMuff](https://github.com/Zizaco/factory-muff)
    +   **Currently Unused**
    +   Assists with object creation when testing
*   [Imagine](https://github.com/avalanche123/Imagine)
    +   **Currently Unused**
    +   An image manipulation package
*   [Markdown](https://github.com/dflydev/dflydev-markdown)
    +   **Currently Unused**
    +   A package for parsing markdown

## Considerations
*   Do any user-related tables need softDeletes besides users?
    +   If the User has been soft deleted, related tables shouldn't matter
        -   When filtering related Models, just check that the related User hasn't been deleted
*   Model Events in the Model vs. global.php
    +   Model - Code is more readable
    +   global.php - Code is more manageable
*   Validation in the Controller vs. Model vs. a service
    +   Controllers - Code is more readable
    +   Model - Code is more manageable
    +   A service - Code is more manageable and Model is kept 'cleaner'
*   Filters in Controllers vs. Routes
    +   Controllers - Code is more readable
    +   Routes - Code is more manageable
*   Sharing Models across all Views vs. binding individually each time a View is created
    +   Sharing - Code is more manageable
    +   Binding - Code is more readable
*   Find a better way to handle Views after AJAX calls (e.g. Login/Logout via AJAX)
    +   Results in duplication of code in the Views

## Testing
*   Config
    +   SQLite - In Memory database
*   The database should always be migrated before running tests (since it always starts off empty)
*   Resource: [Testing Like A Boss In Laravel](http://net.tutsplus.com/tutorials/php/testing-like-a-boss-in-laravel-models/)
*   Test-Driven Development (red/green/refactor)
    1.  (Re)Write a test
    2.  Run all tests and see if the new one fails
    3.  Write some code
    4.  Run Tests
    5.  Refactor code
    6.  Repeat

![TDD](http://upload.wikimedia.org/wikipedia/en/9/9c/Test-driven_development.PNG)
