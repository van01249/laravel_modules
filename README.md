<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Cài đặt

Sau khi clone code về máy thì thực hiện các bước sau trên terminal: <br/>
B1: Chạy lệnh tạo folder vendor chứa các thư viện của dự án

    composer install

B2: Chạy lệnh tạo file .env

    cp .env.example .env

B3: Chạy lệnh tạo key cho dự án:

    php artisan key:generate

B4: Chạy lệnh để khởi tạo database cho dự án

    php artisan migrate
