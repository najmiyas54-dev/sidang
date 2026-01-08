# Project Sidang - Setup Database

## Langkah-langkah Setup Database:

### 1. Persiapan XAMPP
- Pastikan XAMPP sudah terinstall
- Start Apache dan MySQL di XAMPP Control Panel

### 2. Import Database
- Buka phpMyAdmin (http://localhost/phpmyadmin)
- Import file `database/sidang_db.sql`
- Atau jalankan query SQL yang ada di file tersebut

### 3. Konfigurasi Database
File konfigurasi ada di `config/database.php`
```php
private $host = 'localhost';
private $db_name = 'sidang_db';
private $username = 'root';
private $password = '';
```

### 4. Test Koneksi
Jalankan `test_connection.php` untuk memastikan koneksi berhasil

### 5. Untuk Kolaborasi dengan Teman
- Push semua file ke GitHub
- Teman clone repository
- Teman import database yang sama
- Gunakan konfigurasi database yang sama

## Login Default
- Username: admin
- Password: password (hash sudah disediakan)

## Struktur Database
- `users`: untuk autentikasi
- `data_sidang`: untuk data utama project