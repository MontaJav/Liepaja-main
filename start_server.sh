cd XAMPP
open -a manager-osx.app
sleep 5

cd studijas-darbs

open -a Terminal.app "composer install"
sleep 5

open -a Terminal.app "npm install"
sleep 5

open -a Terminal.app "npm run dev"
sleep 5

open -a Terminal.app "php artisan serve"

sleep 10
pkill -f Terminal
open http://127.0.0.1:8000/