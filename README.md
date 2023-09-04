# Laverne-Quiz

Welcome to Laverne-Quiz.



## Deployment

01. Clone you repo `git clone https://github.com/osamatoama/Laverne-quiz-project.git`
02. Run `cp .env.example .env` file to copy example file to `.env`
    Then edit your `.env` file with DB credentials and other settings.
03. Edit APP_URL in your `.env` file with the base url that you open in the browser
04. Run `composer install` command
05. Run `php artisan key:generate` command.
06. Create DB with `laverne` name and `utf8mb4_unicode_ci` collation
07. Update your .env file with `DB_DATABASE=laverne`
08. Run `php artisan project:install` command.
    Notice: seed is important, because it will create the first admin user for you.
09. If you have file/photo fields, run `php artisan storage:link` command.

-----------------------------------------------------------------
