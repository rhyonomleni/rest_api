# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/lumen-framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/lumen-framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/lumen)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

> **Note:** In the years since releasing Lumen, PHP has made a variety of wonderful performance improvements. For this reason, along with the availability of [Laravel Octane](https://laravel.com/docs/octane), we no longer recommend that you begin new projects with Lumen. Instead, we recommend always beginning new projects with [Laravel](https://laravel.com).

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Langkah-langkah menjalankan aplikasi:
1. Clone repositori.
2. Buka project di code editor, di terminal jalankan perintah 'composer update'.
3. Jika belum terinstal composer pada komputer, instal composer dengan panduan sebagai berikut https://getcomposer.org/doc/00-intro.md.
4. Pastikan php_mysqli sudah terinstal pada komputer.
5. Buat file .env sesuai kebutuhan dengan acuan pada file .env.example.
6. Jalankan aplikasi dengan perintah 'php -S localhost:5000 -t public'.

# Dokumentasi REST API

## Table of Contents
1. [Google Login](#google-login)
2. [User](#user)
    - [GET All Users](#get-all-users)
    - [GET User Details](#get-user-details)
    - [PUT Update User](#put-update-user)
    - [DELETE User](#delete-user)
3. [Doa](#doa)
    - [GET All Doa](#get-all-doa)
    - [POST Create Doa](#post-create-doa)
    - [PUT Update Doa](#put-update-doa)
    - [DELETE Doa](#delete-doa)
4. [Renungan](#renungan)
    - [GET All Renungan](#get-all-renungan)
    - [POST Create Renungan](#post-create-renungan)
    - [PUT Update Renungan](#put-update-renungan)
    - [DELETE Renungan](#delete-renungan)
5. [Ibadah](#ibadah)
6. [Kegiatan](#kegiatan)

---

### Google Login
**Endpoint:** `GET /auth/google`  
**Description:** Digunakan oleh admin untuk melakukan login agar mendapatkan auth token.  

---

### User

#### GET All Users
**Endpoint:** `GET /api/user`  
**Description:** Mengambil data semua pengguna.  
**Headers:**
```json
{
  "token": "<your-auth-token>"
}

