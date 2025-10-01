# APLIKASI PENGHITUNGAN & TRANSPARANSI GAJI DPR BERBASIS WEB

## 🏛️ Deskripsi Aplikasi

Aplikasi Penghitungan & Transparansi Gaji DPR Berbasis Web adalah sistem informasi yang dirancang untuk memberikan transparansi penuh terhadap komponen gaji dan tunjangan anggota DPR RI. Aplikasi ini memungkinkan masyarakat untuk mengakses data gaji DPR secara real-time dan transparan.

## ✨ Fitur Utama

### 📊 Dashboard Transparansi
- **Statistik Real-time**: Menampilkan total anggota DPR, gaji pokok, dan anggaran tahunan
- **Data Komponen Gaji**: Tabel detail semua komponen gaji dan tunjangan
- **Grafik Interaktif**: Visualisasi distribusi gaji dan perbandingan anggaran
- **Informasi Transparan**: Semua data dapat diakses publik

### 🧮 Kalkulator Gaji
- Hitung total gaji berdasarkan komponen yang dipilih
- Simulasi perhitungan tunjangan
- Export hasil perhitungan

### 📈 Laporan Detail
- Generate laporan komprehensif tentang anggaran DPR
- Data historis perkembangan anggaran
- Export laporan dalam berbagai format

### 🔐 Sistem Keamanan
- Login/logout dengan session management
- Password hashing yang aman
- CSRF protection
- Input validation dan sanitization

## 💰 Data Gaji DPR RI

| Komponen | Jumlah (Rp) | Keterangan |
|----------|-------------|------------|
| **Gaji Pokok** | 15.500.000 | Gaji dasar anggota DPR |
| **Tunjangan Kehormatan** | 7.500.000 | Tunjangan kehormatan jabatan |
| **Tunjangan Komunikasi** | 3.000.000 | Biaya komunikasi dan koordinasi |
| **Tunjangan Perumahan** | 5.000.000 | Bantuan perumahan |
| **Tunjangan Transportasi** | 2.000.000 | Biaya transportasi dinas |
| **Tunjangan Kesehatan** | 1.500.000 | Asuransi kesehatan |
| **Uang Kehadiran** | 500.000 | Per pertemuan sidang |
| **Uang Saku** | 300.000 | Per hari kerja |

**Total Gaji per Bulan**: Rp 35.300.000 (tanpa uang kehadiran dan saku)

## 🚀 Teknologi yang Digunakan

- **Backend**: CodeIgniter 4
- **Frontend**: Bootstrap 5, Chart.js
- **Database**: MySQL
- **Security**: CSRF Protection, Password Hashing
- **UI/UX**: Responsive Design, Modern Interface

## 📋 Persyaratan Sistem

- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Web server (Apache/Nginx)
- Browser modern (Chrome, Firefox, Safari, Edge)

## 🛠️ Instalasi

1. **Clone Repository**
   ```bash
   git clone [repository-url]
   cd dpr-salary-app
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Konfigurasi Database**
   - Buat database MySQL dengan nama `dpr_database`
   - Update konfigurasi di `app/Config/Database.php`

4. **Jalankan Migration**
   ```bash
   php spark migrate
   ```

5. **Jalankan Seeder (Opsional)**
   ```bash
   php spark db:seed PenggunaSeeder
   ```

6. **Akses Aplikasi**
   - Buka browser dan akses `http://localhost:8080`
   - Login dengan akun yang tersedia

## 👤 Akun Testing

### Admin
- **Username**: admin
- **Password**: admin123
- **Email**: admin@example.com

### User
- **Username**: user1
- **Password**: user123
- **Email**: user1@example.com

## 📱 Screenshots

### Dashboard Utama
- Statistik anggaran DPR
- Grafik distribusi gaji
- Tabel komponen gaji

### Halaman Login
- Form login yang aman
- Validasi input
- Session management

### Data Transparansi
- Tabel detail gaji
- Status komponen
- Informasi real-time

## 🔒 Keamanan

- **Password Hashing**: Menggunakan `password_hash()` dengan `PASSWORD_DEFAULT`
- **CSRF Protection**: Perlindungan terhadap Cross-Site Request Forgery
- **Input Validation**: Validasi dan sanitasi semua input pengguna
- **Session Security**: Pengelolaan session yang aman
- **SQL Injection Protection**: Menggunakan Query Builder CodeIgniter

## 📊 Statistik Aplikasi

- **Total Anggota DPR**: 575 orang
- **Gaji Pokok per Bulan**: Rp 15.5 Miliar
- **Total Anggaran Tahunan**: Rp 8.9 Triliun
- **Tahun Anggaran**: 2024

## 🤝 Kontribusi

Aplikasi ini dikembangkan untuk memberikan transparansi dalam pengelolaan keuangan negara. Kontribusi dan saran sangat diterima untuk pengembangan lebih lanjut.

## 📄 Lisensi

Aplikasi ini dikembangkan untuk keperluan akademik dan transparansi publik.

## 📞 Kontak

Untuk pertanyaan atau informasi lebih lanjut, silakan hubungi tim pengembang.

---

**Dibuat dengan ❤️ untuk Transparansi Indonesia**
