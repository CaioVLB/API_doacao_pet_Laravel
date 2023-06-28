<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Comandos para executar o PROJETO LARAVEL

## Observações
<p align="center">
    require : php 8.1
</p>

## 1° Realizar a instalação das depências do projeto
<p align="center">
    composer install --ignore-platform-reqs
</p>

## 2° Clonar o arquivo .env.example e renomear para .env
<p align="center">
   Linux: cp .env.example .env <br>
   Windows: copy .env.example .env
</p>

## 3° Realizar as modificações necessária no arquivo .env
<p>
    ## Na porta (DB_PORT: 3306) tem que está o mysql, caso essa porta já esteja sendo utilizada e não seja pelo mysql, modifique a porta e coloque o mysql nela.
    <br>
    DB_CONNECTION=mysql <br>
    DB_HOST=127.0.0.1 <br>
    DB_PORT=3306 <br>
    DB_DATABASE=doacao_pet <br>
    DB_USERNAME=root <br>
    DB_PASSWORD= <br>
</p>

## 4° Gerar a APP_KEY do arquivo .env
<p align="center">
    php artisan key:generate
</p>
