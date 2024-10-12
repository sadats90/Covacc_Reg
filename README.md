<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>





<p> 1. Install php and composer in local machine .  </p>
2. Clone the git Repository  -   https://github.com/sadats90/Covacc_Reg.git
3. Copy the .env.example file to create your .env file
4. Open the .env file and provide your database credentials
5. Run in the terminal or command line: composer install
6. Run in the terminal or command line:  php artisan key:generate
7. Run in the terminal or command line:  php artisan migrate
8. Run in the terminal or command line:  php artisan db:  seed --class=VaccineCenterSeeder
9. Run in the terminal or command line:  php artisan db:  seed --class=UserSeeder
10. Run in the termina or command line : php artisan serve 
11. Run this route in your browser to schedule vaccinations:  http://localhost/schedule-vaccinations




