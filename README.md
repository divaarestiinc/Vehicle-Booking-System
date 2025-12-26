🚗 Sekawan Fleet System

Fleet Reservation & Monitoring System

Sekawan Fleet System adalah aplikasi manajemen dan monitoring armada kendaraan yang dikembangkan sebagai proyek portofolio magang (internship) oleh Diva Resti.
Sistem ini dirancang untuk mensimulasikan kebutuhan operasional perusahaan, khususnya pada proses pemesanan kendaraan, persetujuan berjenjang, dan monitoring penggunaan armada serta BBM.

🎯 Tujuan Proyek

Mensimulasikan sistem operasional nyata pada perusahaan (contoh: tambang, logistik, atau operasional lapangan)

Menerapkan multi-level approval workflow

Melatih pengembangan aplikasi berbasis Laravel dengan manajemen role, data, dan laporan

🧩 Fitur Utama

Multi-level Approval

Persetujuan pemesanan kendaraan oleh Approver Level 1 dan Approver Level 2

Fleet Reservation

Pemesanan kendaraan oleh user dengan status terkontrol

Monitoring Armada & BBM

Pencatatan penggunaan kendaraan dan estimasi konsumsi BBM di akhir perjalanan

Manajemen User & Role

Admin dapat mengubah role user (Admin / Approver) dan menonaktifkan akun

Log Aktivitas

Pencatatan setiap aksi penting untuk kebutuhan audit

Ekspor Laporan

Data pemesanan dan penggunaan armada dapat diunduh dalam format Excel

🛠️ Teknologi yang Digunakan

Framework: Laravel 12

Bahasa: PHP 8.2+

Database: MySQL 8.0

UI Framework: Bootstrap 5

Icon: FontAwesome 6

Visualisasi Data: Chart.js

👥 Role & Hak Akses
Role	Deskripsi
Admin	Mengelola user, role, data kendaraan, dan monitoring sistem
Approver Level 1	Persetujuan awal pemesanan kendaraan
Approver Level 2	Persetujuan akhir sebelum kendaraan digunakan
🔑 Akun Uji Coba

Gunakan akun berikut untuk mencoba alur sistem secara lengkap:

Role	Email	Password
Admin	admin@mail.com
	password
Approver Level 1	boss1@mail.com
	password
Approver Level 2	bos2@mail.com
	password
  
🔄 Alur Sistem

User/Admin melakukan pemesanan kendaraan

Approver Level 1 melakukan verifikasi awal

Approver Level 2 memberikan persetujuan akhir

Kendaraan digunakan dan dimonitor

Sistem mencatat penggunaan dan estimasi BBM

Data tersimpan dan dapat diekspor sebagai laporan

🚀 Instalasi (Local Development)
git clone https://github.com/username/sekawan-fleet-system.git
cd sekawan-fleet-system
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve


Pastikan:

PHP ≥ 8.2

Composer terpasang

MySQL aktif

📌 Catatan

Proyek ini dikembangkan untuk keperluan pembelajaran dan portofolio magang

Struktur sistem dibuat mendekati kebutuhan operasional nyata

Masih terbuka untuk pengembangan lanjutan (fitur GPS, notifikasi, dsb.)

👤 Pengembang

Diva Resti
Pelamar Magang (Internship)
Bidang: Web Development / Backend (Laravel)
