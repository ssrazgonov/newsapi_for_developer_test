# News Parser for Lumen Developer

Порядок установки:
1. composer install
2. php artisan migrate
3. php artisan db:seed

Запуск
1. одиночный запуск php artisan parse
2. scheduler запуск php artisan schedule:run

API routes с группировкой

1. GET: /api/news/group/date
2. GET: /api/news/group/theme
3. GET: /api/news/group/source
