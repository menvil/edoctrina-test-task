# QuizApplication 

1. Clone the repo: git clone git@github.com:menvil/quizapplication.git
2. Install Laravel: composer install --prefer-dist
3. Rename file .env.example to .env and dit file .env for proper database values

DB_HOST=127.0.0.1
DB_DATABASE=testtask
DB_USERNAME=root
DB_PASSWORD=

4. Migrate your database: php artisan migrate
5. Seed your database: php artisan db:seed
6. Make php artisan key:generate
7. View application in the browser!