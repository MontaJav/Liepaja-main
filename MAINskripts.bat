cd C:\xampp
start xampp-control.exe
timeout /t 5
cd /d D:\Liepaja

start cmd /k "composer install"
timeout /t 10

start cmd /k "npm install"
timeout /t 5

start cmd /k "npm run dev"
timeout /t 5

start cmd /k "php artisan serve"

timeout /t 10
taskkill /f /fi "WINDOWTITLE eq Administrator: *"
start http://127.0.0.1:8000/