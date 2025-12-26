# 🚗 Sekawan Fleet System
**Fleet Reservation & Monitoring System**

Sekawan Fleet System adalah aplikasi **manajemen dan monitoring armada kendaraan** yang dikembangkan sebagai proyek **portofolio magang (internship)** oleh **Diva Resti**.  
Sistem ini mensimulasikan kebutuhan operasional perusahaan dalam pengelolaan pemesanan kendaraan, persetujuan berjenjang, serta monitoring penggunaan armada dan konsumsi BBM.

---

## 🎯 Tujuan Proyek
- Menerapkan sistem **fleet reservation** berbasis web
- Mengimplementasikan **multi-level approval workflow**
- Melatih pengembangan aplikasi menggunakan **Laravel** dengan role-based access control
- Menyediakan data monitoring dan laporan operasional

---

## 🧩 Fitur Utama
- **Multi-level Approval**
  - Persetujuan pemesanan oleh Approver Level 1 dan Level 2
- **Fleet Reservation**
  - Pemesanan kendaraan dengan status terkontrol
- **Monitoring Armada & BBM**
  - Pencatatan penggunaan kendaraan dan estimasi konsumsi BBM
- **Manajemen User & Role**
  - Admin dapat mengatur role dan status akun
- **Log Aktivitas**
  - Riwayat aktivitas untuk audit
- **Ekspor Laporan**
  - Unduh data dalam format Excel

---

## 🛠️ Teknologi yang Digunakan
- **Framework**: Laravel 12  
- **Bahasa**: PHP 8.2+  
- **Database**: MySQL 8.0  
- **UI Framework**: Bootstrap 5  
- **Icon**: FontAwesome 6  
- **Visualisasi Data**: Chart.js  

---

## 👥 Role Pengguna
| Role | Deskripsi |
|---|---|
| Admin | Mengelola user, role, data kendaraan, dan laporan |
| Approver Level 1 | Persetujuan awal pemesanan kendaraan |
| Approver Level 2 | Persetujuan akhir pemesanan kendaraan |

---

## 🔑 Akun Uji Coba
Gunakan akun berikut untuk mencoba alur sistem secara lengkap:

| Role | Email | Password |
|---|---|---|
| Admin | admin@mail.com | password |
| Approver Level 1 | boss1@mail.com | password |
| Approver Level 2 | boss2@mail.com | password |

---

## 🔄 Alur Sistem
1. User/Admin membuat pemesanan kendaraan  
2. Approver Level 1 melakukan persetujuan awal  
3. Approver Level 2 memberikan persetujuan akhir  
4. Kendaraan digunakan  
5. Sistem mencatat penggunaan dan BBM  
6. Data dapat diekspor sebagai laporan  

---

## 🚀 Instalasi (Local Development)

### 1. Clone Repository
```bash
https://github.com/username/Vehicle-Booking-System.git
cd sekawan-fleet-system

2. Install Dependency
composer install

3. Konfigurasi Environment
cp .env.example .env
php artisan key:generate


Atur koneksi database pada file .env.

4. Migrasi Database
php artisan migrate --seed

5. Jalankan Aplikasi
php artisan serve
