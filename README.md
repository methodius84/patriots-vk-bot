<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About

<p>
Пилотный проект с использованием докер.
Песочница и одновременно боевой проект - чат-бот VK для сообщества.
</p>

## NGROK TESTING

1. Добавить в переменную окружения ```HOME_DIR``` путь ```/home/$USER```, где $USER - имя пользователя системы
2. Добавить туннель в ```/home/$USER/.config/ngrok/ngrok.yml``` следующий туннель:
    ```
    tunnels:
      dev:
        proto: http
        addr: nginx:80
    ```
