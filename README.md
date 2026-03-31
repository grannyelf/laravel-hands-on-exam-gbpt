<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a>

## Instructions For Setting Up

First you need to copy the link inside the green button named "<> Code".
</br>
Once you copied it, open visual studio code and press "Clone Repository" and a search bar will appear in the top area, now paste the link in that search bar and press enter.
</br>
Then, type this inside the TERMINAL in order:

- composer install
- npm install preline@3.2.3
- Optional: npm run build
- copy .env.example .env
- php artisan key:generate
- php artisan migrate --seed

Once finish to test the code, type "php artisan serve" in the terminal, then ctrl + click the IP given.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
