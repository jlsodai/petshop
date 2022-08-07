<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://www.buckhill.co.uk/assets/images/xlogo-blue.png.pagespeed.ic.PYdYfUPDLG.webp" width="200"></a></p>

## About Project

API Backend for PetShop built with Laravel:

### Project Setup

After cloning the repo, cd into the project folder and run ```composer install``` to install all dependencies.

Next, make a copy of ```.env.example``` file and name it ```.env```. Next run ```php artisan key:generate``` to generate an application key, create your database and input its credentials in the .env file.

### Run Migrations and Seeder

In order to create the tables for the project, run ```php artisan migrate``` and then run ```php artisan db:seed``` to populate the database table with dummy test records.

### JWT Setup

Run ```php artisan jwt:secret``` to generate the jwt secret for the project. Next, add ```JWT_ALGO=RS256``` to the ```.env``` file. This is very important and required to generate the certificates.

Next, run ```php artisan jwt:generate-certs``` to generate certificates. The ```.env``` file will be updated with the new keys. Visit https://laravel-jwt-auth.readthedocs.io to read the documentations of the JWT package used in this project.

### API Documentation

Visit {{base_url}}/api/documentation to see the project's API Docs

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
