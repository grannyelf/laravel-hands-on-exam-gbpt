<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a>

## Instructions For Setting Up
# Downloading + Setting Up


# Cloning Repository
First you need to copy the link inside the green button named "<> Code".
</br>
Once you copied it, open visual studio code and press "Clone Repository" and a search bar will appear in the top area, now paste the link in that search bar and press enter.
</br>
Now once the file destination pop-up, go to this file location "C:\laragon\www" and press "Select Repository".
</br>
Then, type this inside the TERMINAL in order:
(Note: Turn on your laravel first if it's not turned on yet)
- composer install
- npm install preline@3.2.3
- npm audit fix
- npm run build
- copy .env.example .env
- php artisan key:generate
- php artisan migrate --seed (then type "yes" in the terminal once it's asking you to make a database)

Once finish to test the code, type "php artisan serve" in the terminal, then ctrl + click the IP given.

The Admin account is:
Email: admin@gmail.com
Passw: 123123123

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
