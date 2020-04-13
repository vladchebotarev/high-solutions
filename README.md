##Installation

Clone GitHub repo for this project locally:

`git clone https://github.com/vladchebotarev/high-solutions.git`

cd into your project

`cd high-solutions`

Install Composer Dependencies

`composer install`

Install NPM Dependencies (Optional)

`npm install`

Create a copy of .env file

`cp .env.example .env`

Generate an app encryption key

`php artisan key:generate`

Create an empty database for our application. In the .env file, add database information to allow Laravel to connect to the database.

Migrate the database

`php artisan migrate`

Seed the database

`php artisan db:seed`

Start the server

`php artisan serve`

##Optional
All js and css assets was build for production, if you want to make changes in js/css code, install NPM Dependencies.

`npm install`

`npm run dev`

## Author
Vladislav Chebotarev
wczebotarew@gmail.com

## License

This is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
