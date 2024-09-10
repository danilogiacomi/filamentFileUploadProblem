
## Filament FileUpload issue

This repo shows a problem where multiple file uploads may end up with missing files.

After composer install, and configuring the .env file, run the migration with seeder

# php artisan migrate:fresh --seed

## URL and user

The seeder creates a filament user with the following credential
 - email: user@example.org
 - password: user

The Filament Panel is found at the /admin URL 

## Example Files

In the exampleFiles dir you can find 32 example files to be used to test the behaviour.

## Testing the issue

Then there are two filament resources:
  - Orders
  - PollingOrders

The only difference between the two is to be found in the relation manager files, in particular the PollingOrders one has ->poll('5s') whereas the other does not.

The problem appears only on the PollingOrders Resource, so the polling somewhat makes it happen.

First create a new Order or PollingOrder, then a "Mass Upload Images" button will appear, it opens a modal and this is where the FileUpload is located and where you can test the behaviour.

## Issue Randomness

The issue has a random nature, sometimes it works flowlessly, sometimes one file is missing, other times more than one file are missing and not always the same ones.

This was tested on Linux with sail, and with a nginx/php-fpm dockerized environment (which is very similar to what sail does, except it's not running php artisan serve, and it's what we normally use in production).

On MacOs (with laravel/Valet and with laravel/Sail) the issue appears to not be present. 