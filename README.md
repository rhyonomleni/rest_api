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
```

#### GET User Details
**Endpoint:** `GET /api/user/{id}`  
**Description:** Mengambil detail data seorang pengguna.  
**Headers:**
```json
{
  "token": "<your-auth-token>"
}
```

#### PUT Update User
**Endpoint:** `PUT /api/user/{id}`  
**Description:** Memperbarui data pengguna.  
**Headers:**
```json
{
  "token": "<your-auth-token>"
}
```
**Body:**
```json
{
  "nama_lengkap": "Andrian",
  "tanggal_lahir": "01-02-2002",
  "tempat_lahir": "Jakarta",
  "no_telp": "081234567890",
  "alamat": "Jakarta",
  "pendidikan_terakhir": "SMA",
  "klasis": "Yogyakarta",
  "profesi": "PNS",
  "profile_picture": "https://example.com/profile.jpg"
}
```

#### DELETE User
**Endpoint:** `DELETE /api/user/{id}`  
**Description:** Menghapus data pengguna.  
**Headers:**
```json
{
  "token": "<your-auth-token>"
}
```

---

### Doa

#### GET All Doa
**Endpoint:** `GET /api/doa`  
**Description:** Mengambil semua data doa.  

#### POST Create Doa
**Endpoint:** `POST /api/doa`  
**Description:** Menambahkan data doa.  
**Headers:**
```json
{
  "token": "<your-auth-token>"
}
```
**Body:**
```json
{
  "judul": "Doa awal tahun",
  "tanggal": "2021-11-02",
  "detail": "Untuk memulai tahun yang baru"
}
```

#### PUT Update Doa
**Endpoint:** `PUT /api/doa/{id}`  
**Description:** Memperbarui data doa.  
**Headers:**
```json
{
  "token": "<your-auth-token>"
}
```
**Body:**
```json
{
  "judul": "Doa akhir tahun",
  "detail": "Untuk mengakhiri tahun"
}
```

#### DELETE Doa
**Endpoint:** `DELETE /api/doa/{id}`  
**Description:** Menghapus data doa.  
**Headers:**
```json
{
  "token": "<your-auth-token>"
}
```

---

### Renungan

#### GET All Renungan
**Endpoint:** `GET /api/renungan`  
**Description:** Mengambil semua data renungan.  

#### POST Create Renungan
**Endpoint:** `POST /api/renungan`  
**Description:** Menambahkan data renungan.  
**Headers:**
```json
{
  "token": "<your-auth-token>"
}
```
**Body:**
```json
{
  "judul": "Renungan malam",
  "tanggal": "2024-09-02",
  "nats": "Matius 2:1",
  "ayat": "Lorem ipsum",
  "renungan": "Lorem ipsum"
}
```

#### PUT Update Renungan
**Endpoint:** `PUT /api/renungan/{id}`  
**Description:** Memperbarui data renungan.  
**Headers:**
```json
{
  "token": "<your-auth-token>"
}
```

#### DELETE Renungan
**Endpoint:** `DELETE /api/renungan/{id}`  
**Description:** Menghapus data renungan.  
**Headers:**
```json
{
  "token": "<your-auth-token>"
}
```

---

### Ibadah

#### GET All Ibadah
**Endpoint:** `GET /api/ibadah`  
**Description:** Mengambil semua data ibadah.  

#### POST Create Ibadah
**Endpoint:** `POST /api/ibadah`  
**Description:** Menambahkan data ibadah.  
**Headers:**
```json
{
  "token": "<your-auth-token>"
}
```

#### PUT Update Ibadah
**Endpoint:** `PUT /api/ibadah/{id}`  
**Description:** Memperbarui data ibadah.  
**Headers:**
```json
{
  "token": "<your-auth-token>"
}
```

#### DELETE Ibadah
**Endpoint:** `DELETE /api/ibadah/{id}`  
**Description:** Menghapus data ibadah.  
**Headers:**
```json
{
  "token": "<your-auth-token>"
}
```

---

### Kegiatan

#### GET All Kegiatan
**Endpoint:** `GET /api/kegiatan`  
**Description:** Mengambil semua data kegiatan.  

#### POST Create Kegiatan
**Endpoint:** `POST /api/kegiatan`  
**Description:** Menambahkan data kegiatan.  
**Headers:**
```json
{
  "token": "<your-auth-token>"
}
```

#### PUT Update Kegiatan
**Endpoint:** `PUT /api/kegiatan/{id}`  
**Description:** Memperbarui data kegiatan.  
**Headers:**
```json
{
  "token": "<your-auth-token>"
}
```

#### DELETE Kegiatan
**Endpoint:** `DELETE /api/kegiatan/{id}`  
**Description:** Menghapus data kegiatan.  
**Headers:**
```json
{
  "token": "<your-auth-token>"
}
