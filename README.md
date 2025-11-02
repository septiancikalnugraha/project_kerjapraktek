# Sistem Informasi Penjualan dan Keuangan
## CV. PANCA INDRA KEMASAN

Sistem informasi terintegrasi untuk mengelola penjualan dan keuangan sebagai upaya peningkatan efisiensi operasional.

## Fitur Utama

- ✅ **Homepage** - Halaman beranda dengan informasi sistem
- ✅ **Login** - Sistem autentikasi pengguna
- ✅ **Registrasi** - Pendaftaran pengguna baru
- ✅ **Dashboard** - Dashboard utama dengan statistik dan ringkasan data
- ✅ **Manajemen Penjualan** - Kelola transaksi penjualan
- ✅ **Manajemen Produk** - Kelola katalog produk dan stok
- ✅ **Manajemen Keuangan** - Pencatatan pemasukan dan pengeluaran
- ✅ **Manajemen Pelanggan** - Database pelanggan
- ✅ **Laporan** - Laporan penjualan dan keuangan

## Teknologi yang Digunakan

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Server**: XAMPP (Apache)

## Instalasi

### 1. Persyaratan Sistem

- XAMPP atau Apache + PHP + MySQL
- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Browser modern (Chrome, Firefox, Edge, Safari)

### 2. Instalasi Database

1. Buka phpMyAdmin melalui `http://localhost/phpmyadmin`
2. Import file `database.sql` yang ada di root folder project
3. Atau jalankan perintah SQL secara manual untuk membuat database dan tabel

### 3. Konfigurasi Database

Edit file `config/database.php` dan sesuaikan dengan konfigurasi database Anda:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');  // Sesuaikan dengan password MySQL Anda
define('DB_NAME', 'kerjapraktek_db');
```

### 4. Struktur Folder

```
project_kerjapraktek/
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── main.js
├── config/
│   ├── database.php
│   └── auth.php
├── index.php          (Homepage)
├── login.php          (Halaman Login)
├── register.php       (Halaman Registrasi)
├── dashboard.php      (Dashboard Utama)
├── logout.php         (Logout)
├── database.sql       (Struktur Database)
└── README.md          (Dokumentasi)
```

### 5. Akses Sistem

Setelah instalasi selesai, akses sistem melalui:

- **Homepage**: `http://localhost/project_kerjapraktek/`
- **Login**: `http://localhost/project_kerjapraktek/login.php`

## Akun Administrator

Untuk membuat akun administrator pertama kali, Anda memiliki 2 pilihan:

### Opsi 1: Menggunakan Setup Script (Direkomendasikan)
1. Akses: `http://localhost/project_kerjapraktek/setup_admin.php`
2. Isi form untuk membuat akun admin
3. **Hapus file `setup_admin.php` setelah setup selesai** untuk keamanan

### Opsi 2: Menggunakan Form Registrasi
1. Akses halaman registrasi: `http://localhost/project_kerjapraktek/register.php`
2. Daftar sebagai user biasa (role: kasir)
3. Ubah role menjadi 'admin' melalui database jika diperlukan

**⚠️ PENTING**: 
- Pastikan password admin kuat dan aman
- Jangan lupa hapus `setup_admin.php` setelah digunakan
- Simpan kredensial admin di tempat yang aman

## Struktur Database

### Tabel Utama

1. **users** - Data pengguna sistem
2. **categories** - Kategori produk
3. **products** - Data produk
4. **customers** - Data pelanggan
5. **sales** - Transaksi penjualan
6. **sale_items** - Detail item penjualan
7. **income** - Pencatatan pemasukan
8. **expenses** - Pencatatan pengeluaran

## Fitur Keamanan

- ✅ Password di-hash menggunakan `password_hash()` (bcrypt)
- ✅ Session-based authentication
- ✅ SQL injection protection dengan prepared statements
- ✅ XSS protection dengan `htmlspecialchars()`
- ✅ Role-based access control

## Pengembangan Lebih Lanjut

Untuk pengembangan fitur tambahan, sistem ini dapat dikembangkan dengan:

- Modul penjualan (POS)
- Modul pembelian (Purchasing)
- Modul inventory management
- Modul laporan lengkap dengan grafik
- Modul pengaturan (Settings)
- API untuk integrasi eksternal

## Troubleshooting

### Masalah Koneksi Database

1. Pastikan MySQL service berjalan di XAMPP
2. Periksa konfigurasi di `config/database.php`
3. Pastikan database sudah dibuat dan diimport

### Masalah Session

1. Pastikan `session_start()` dipanggil sebelum output
2. Periksa setting `session.save_path` di `php.ini`

### Masalah Permission

1. Pastikan folder memiliki permission yang tepat
2. Pastikan PHP memiliki akses ke folder project

## Kontak & Support

Untuk pertanyaan dan dukungan, silakan hubungi tim pengembang.

## Lisensi

© 2024 CV. PANCA INDRA KEMASAN. All rights reserved.

---

**Catatan**: Sistem ini adalah kerangka awal (framework) untuk implementasi Sistem Informasi Penjualan dan Keuangan. Fitur lengkap dapat dikembangkan sesuai kebutuhan bisnis.

