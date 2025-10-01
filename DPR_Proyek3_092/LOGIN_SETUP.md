# APLIKASI PENGHITUNGAN & TRANSPARANSI GAJI DPR BERBASIS WEB

Fitur login dan logout telah berhasil dibuat untuk aplikasi CodeIgniter 4 dengan tema transparansi gaji DPR berdasarkan struktur tabel `pengguna` yang diberikan.

## Struktur Database

Tabel `pengguna` dengan struktur:
- `id_pengguna` (BIGINT, Primary Key)
- `username` (VARCHAR 15, Unique)
- `password` (VARCHAR 128, Hashed Password)
- `email` (VARCHAR 255, Unique)
- `nama_depan` (VARCHAR 100)
- `nama_belakang` (VARCHAR 100)
- `role` (ENUM: admin, user)

## File yang Dibuat

### 1. Migration
- `app/Database/Migrations/2024-01-01-000001_CreatePenggunaTable.php`

### 2. Model
- `app/Models/PenggunaModel.php`

### 3. Controller
- `app/Controllers/Auth.php` - Menangani login, logout, dan register
- `app/Controllers/Dashboard.php` - Halaman dashboard setelah login

### 4. Views
- `app/Views/auth/login.php` - Halaman login
- `app/Views/auth/register.php` - Halaman registrasi
- `app/Views/dashboard/index.php` - Halaman dashboard

### 5. Filter
- `app/Filters/AuthFilter.php` - Filter untuk melindungi halaman yang memerlukan login

### 6. Seeder
- `app/Database/Seeds/PenggunaSeeder.php` - Data sample untuk testing

## Cara Setup

### 1. Jalankan Migration
```bash
php spark migrate
```

### 2. Jalankan Seeder (Opsional)
```bash
php spark db:seed PenggunaSeeder
```

### 3. Konfigurasi Database
Pastikan database sudah dikonfigurasi di `app/Config/Database.php` dan file `.env`.

## Akun Testing

Setelah menjalankan seeder, Anda dapat menggunakan akun berikut:

**Admin:**
- Username: `admin`
- Password: `admin123`
- Email: `admin@example.com`

**User:**
- Username: `user1`
- Password: `user123`
- Email: `user1@example.com`

- Username: `user2`
- Password: `user123`
- Email: `user2@example.com`

## Fitur yang Tersedia

### 1. Login
- URL: `/auth/login`
- Validasi username dan password
- Session management
- Redirect berdasarkan role (admin/user)

### 2. Logout
- URL: `/auth/logout`
- Menghapus session
- Redirect ke halaman login

### 3. Register
- URL: `/auth/register`
- Validasi form lengkap
- Password hashing otomatis
- Role default: user

### 4. Dashboard Transparansi DPR
- URL: `/dashboard`
- Menampilkan data gaji dan tunjangan DPR
- Statistik anggaran tahunan
- Grafik distribusi komponen gaji
- Tabel detail komponen gaji
- Dilindungi dengan auth filter

### 5. Protected Routes
- Dashboard dan admin routes dilindungi dengan auth filter
- Redirect otomatis ke login jika belum authenticated

### 6. Data Gaji DPR
- Gaji Pokok: Rp 15.500.000
- Tunjangan Kehormatan: Rp 7.500.000
- Tunjangan Komunikasi: Rp 3.000.000
- Tunjangan Perumahan: Rp 5.000.000
- Tunjangan Transportasi: Rp 2.000.000
- Tunjangan Kesehatan: Rp 1.500.000
- Uang Kehadiran: Rp 500.000 (per pertemuan)
- Uang Saku: Rp 300.000 (per hari kerja)

## Keamanan

- Password di-hash menggunakan `password_hash()` dengan `PASSWORD_DEFAULT`
- CSRF protection pada form
- Session management yang aman
- Input validation dan sanitization
- SQL injection protection melalui Query Builder

## Customization

Anda dapat menyesuaikan:
- Validasi rules di `PenggunaModel.php`
- Styling di view files
- Redirect URLs setelah login/logout
- Role-based access control
- Session timeout

## Testing

1. Akses halaman utama `/`
2. Klik "Login" atau "Register"
3. Test dengan akun yang tersedia
4. Coba akses `/dashboard` tanpa login (akan redirect ke login)
5. Test logout functionality

## Troubleshooting

Jika mengalami masalah:
1. Pastikan database sudah dikonfigurasi dengan benar
2. Jalankan migration terlebih dahulu
3. Check file `.env` untuk konfigurasi database
4. Pastikan session driver sudah aktif
5. Check log di `writable/logs/` untuk error details
