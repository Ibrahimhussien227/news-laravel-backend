## Installation Docker

This is a news backend project that will collect news from various sources and store it in the database.

-   Clone it `git@github.com:Ibrahimhussien227/news-laravel-backend.git`
-   Change path tho this project root from the terminal `cd /path/to/news-laravel`
-   Copy `.env-prod` to `.env`, it's containing API KEY, update the DB connection details.
-   Build Container `COMPOSE_DOCKER_CLI_BUILD=1 DOCKER_BUILDKIT=1 ./vendor/bin/sail build`
-   Run the app `./vendor/bin/sail up -d`
-   Generate a key `./vendor/bin/sail artisan key:generate`
-   Migrate the Database `./vendor/bin/sail artisan migrate --force`
-   Run the schedule to get news `./vendor/bin/sail artisan schedule:work`

## Installation Manual

-   Clone it `https://github.com/Ibrahimhussien227/news-laravel-backend.git`
-   Change path tho this project root from the terminal `cd /path/to/news-laravel`
-   Copy `.env.example` to `.env`, it's containing API KEY, update the DB connection details.
-   Install it by composer `composer install`
-   Migrate the Database `php artisan migrate`
-   Run `php artisan serve`
-   Run the schedule to get news `php artisan schedule:work`

### Adding API key to env value

To retrieve news from various sources, you need to include these API keys.

-   `NEWS_API="e334015d835744d1bd3b95c55effbd4c"`
-   `ed38629f-c395-4fa1-b94f-c2ff78f130e8"`
-   `NYTIMES="rXrxS8tUtzGGmgUgQ0Bc9kG7z6dRJtvp"`

Run this application and copy the backend application's URL, as you will need it to configure the ReactJS application.
