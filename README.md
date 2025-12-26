🏁 Fleet Reservation System - PT Sekawan Media InformatikaSistem Monitoring Kendaraan yang dirancang khusus untuk operasional perusahaan tambang nikel. Sistem ini memfasilitasi pemesanan armada dengan mekanisme persetujuan berjenjang (Approver Level 1 & Level 2) serta pemantauan konsumsi BBM secara real-time.

📦 Informasi 
SistemFramework: Laravel 12PHP 
Version: 8.2+
Database: MySQL 8.0
UI Framework: Bootstrap 5 + FontAwesome 6 (Custom Dashboard Industrial Style)

🔑 Akun Uji CobaGunakan kredensial berikut untuk menguji alur kerja sistem 
(Booking -> Approval Lvl 1 -> Approval Lvl 2 -> Finish):RoleEmailPasswordAdminadmin@mail.compasswordApprover 1boss1@mail.compasswordApprover 2boss2@mail.compassword🛠️ Fitur Utama & Bonus PointsLog Activity: Pencatatan otomatis setiap aksi penting, seperti pengubahan role user atau persetujuan pesanan, yang ditampilkan pada dashboard utama.Persetujuan Berjenjang: Alur kerja validasi pesanan oleh dua tingkat penyetuju berbeda untuk meningkatkan kontrol keamanan operasional.Manajemen Personil: Fitur CRUD lengkap untuk Admin dalam mengelola role (Admin/Approver) dan status keaktifan user (is_active).Monitoring BBM: Visualisasi estimasi konsumsi bahan bakar berdasarkan riwayat perjalanan armada yang telah selesai.Responsive UI: Antarmuka dashboard dan manajemen yang telah dioptimalkan agar dapat diakses melalui smartphone secara nyaman.Physical Data Model: Struktur basis data yang optimal dengan relasi antar tabel (Users, Bookings, Activity Logs) yang menjaga integritas data.🚀 Cara Menjalankan Secara LokalPersiapan:Bashgit clone https://github.com/username/sekawan-fleet.git
composer install
npm install && npm run build
Environment:Ubah .env.example menjadi .env dan sesuaikan koneksi database MySQL Anda.Database & Seeder:Bashphp artisan key:generate
php artisan migrate --seed
Pastikan migrasi mencakup kolom role dan is_active.Akses:Jalankan php artisan serve dan buka http://127.0.0.1:8000.🌐 DeploymentAplikasi ini siap di-deploy menggunakan layanan berbasis GitHub seperti Koyeb atau Railway. Jangan lupa untuk menambahkan Middleware CheckRole dan mendaftarkannya pada bootstrap/app.php untuk memastikan keamanan rute.PT Sekawan Media Informatika - Solusi Enterprise untuk Manajemen Armada Tambang.