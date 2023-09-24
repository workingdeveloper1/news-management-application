## Install Project
1. Clone repository https://github.com/workingdeveloper1/news-management-application.git
2. cd news-management-application
3. cp .env.example .env
4. composer install
5. php artisan key:generate
6. Buat database baru pada mysql
7. Setting database pada file .env (DB_DATABASE=nama_database_mysql)
8. php artisan migrate
10. php artisan db:seed
11. php artisan passport:install --force
12. Install dan jalankan redis
13. php artisan serve
