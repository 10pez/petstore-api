# Petstore API

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Table of Contents
- [Technologies Used](#technologies-used)
- [Installation Instructions](#installation-instructions)


## Technologies Used

This project uses the following technologies:

- **PHP Version**: 8.2.0 
- **Node.js Version**: 22.9.0
- **Framework**: Laravel 11.38.2
- **Frontend**: Bootstrap 5.2.3

## Installation Instructions

Follow these steps to set up the project locally:

1. **Clone the repository**:
   ```bash
   git clone https://github.com/10pez/petstore-api.git
   cd petstore-api

2. **Instal PHP dependencies using Composer**:
    ```bash
    composer install

3. **Install Node.js dependencies**
    ```bash
    npm install

4. **Set up your environment variables by copying .env.example to .env:**
    ```bash
    cp .env.example .env

5. **Generate an application key**
    ```bash
    php artisan key:generate

6. **Run the application using Laravel's development server:**
    ```bash
    php artisan serve
