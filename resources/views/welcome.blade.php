<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sekawan Fleet - Vehicle Management</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-dark: #1a2a3a;
            --accent-blue: #00d2ff;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .hero-section {
            background: linear-gradient(rgba(26, 42, 58, 0.85), rgba(26, 42, 58, 0.85)), 
                        url('https://images.unsplash.com/photo-1578319439584-104c94d37305?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            min-height: 80vh;
            display: flex;
            align-items: center;
            color: white;
            padding: 80px 0;
            clip-path: polygon(0 0, 100% 0, 100% 90%, 0% 100%);
        }
        .hero-title {
            font-weight: 800;
            font-size: 3.5rem;
            line-height: 1.2;
        }
        .hero-title span {
            color: var(--accent-blue);
        }
        .hero-img-container {
            border: 8px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.5);
        }
        .feature-box {
            background: white;
            border-radius: 15px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: 0.3s;
            border-bottom: 5px solid transparent;
            margin-top: -100px; 
            z-index: 10;
            position: relative;
        }
        .feature-box:hover {
            transform: translateY(-10px);
            border-bottom: 5px solid var(--accent-blue);
        }
        .icon-circle {
            width: 80px;
            height: 80px;
            background: #eef9ff;
            color: #0099ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
        }
        .btn-custom {
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-login {
            background-color: var(--accent-blue);
            color: white;
            border: none;
        }
        .btn-login:hover {
            background-color: #00b8e6;
            color: white;
            box-shadow: 0 10px 20px rgba(0, 210, 255, 0.3);
        }
        .btn-outline-custom {
            border: 2px solid white;
            color: white;
        }
        .btn-outline-custom:hover {
            background: white;
            color: var(--primary-dark);
        }
    </style>
</head>
<body>

    <header class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <span class="badge bg-primary mb-3 px-3 py-2 rounded-pill">Fleet Management System v1.0</span>
                    <h1 class="hero-title mb-4">
                        Optimalkan Armada <br><span>Tambang Anda.</span>
                    </h1>
                    <p class="lead mb-5 opacity-75">
                        Sistem monitoring kendaraan tambang terpadu. Kelola pemesanan, pemantauan BBM, dan persetujuan berjenjang dalam satu platform modern.
                    </p>
                    
                    <div class="d-flex gap-3">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-custom btn-login">Buka Dashboard <i class="fas fa-arrow-right ms-2"></i></a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-custom btn-login">Masuk ke Sistem</a>
                                <a href="#features" class="btn btn-custom btn-outline-custom">Pelajari Fitur</a>
                            @endauth
                        @endif
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="hero-img-container">
                        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80" class="img-fluid" alt="Mining Truck">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="features" class="pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="feature-box">
                        <div class="icon-circle">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5 class="fw-bold">Multi-level Approval</h5>
                        <p class="text-muted small">Keamanan ekstra dengan sistem persetujuan minimal 2 level atasan secara berjenjang.</p>
                        <a href="#" class="text-decoration-none fw-bold small" data-bs-toggle="modal" data-bs-target="#modalApproval"># Pelajari Fitur</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-box">
                        <div class="icon-circle">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h5 class="fw-bold">Analitik Real-time</h5>
                        <p class="text-muted small">Visualisasi penggunaan armada melalui dashboard grafis yang interaktif dan informatif.</p>
                        <a href="#" class="text-decoration-none fw-bold small" data-bs-toggle="modal" data-bs-target="#modalAnalitik"># Pelajari Fitur</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-box">
                        <div class="icon-circle">
                            <i class="fas fa-gas-pump"></i>
                        </div>
                        <h5 class="fw-bold">Monitoring BBM</h5>
                        <p class="text-muted small">Pantau konsumsi bahan bakar setiap unit kendaraan operasional secara presisi.</p>
                        <a href="#" class="text-decoration-none fw-bold small" data-bs-toggle="modal" data-bs-target="#modalBBM"># Pelajari Fitur</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modalApproval" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-user-check fa-3x text-primary mb-3"></i>
                        <h4 class="fw-bold">Manajemen Persetujuan Berjenjang</h4>
                    </div>
                    <p class="text-secondary text-center">Sistem ini menjamin akuntabilitas penggunaan kendaraan perusahaan melalui alur persetujuan minimal 2 level:</p>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item border-0 px-0 small"><i class="fas fa-check-circle text-success me-2"></i><strong>Level 1 (Manager):</strong> Verifikasi kebutuhan operasional di lapangan.</li>
                        <li class="list-group-item border-0 px-0 small"><i class="fas fa-check-circle text-success me-2"></i><strong>Level 2 (Head Office):</strong> Validasi ketersediaan anggaran dan logistik pusat.</li>
                    </ul>
                    <div class="alert alert-light border-0 rounded-3 small text-muted">
                        Mencegah penyalahgunaan aset dan memastikan setiap unit armada beroperasi sesuai dengan izin resmi otoritas terkait.
                    </div>
                    <button type="button" class="btn btn-primary w-100 rounded-3 fw-bold" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAnalitik" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-project-diagram fa-3x text-info mb-3"></i>
                        <h4 class="fw-bold">Analitik Real-time & Visualisasi</h4>
                    </div>
                    <p class="text-secondary text-center">Dashboard interaktif yang mengubah data operasional mentah menjadi wawasan bisnis yang berharga:</p>
                    <div class="row g-3 mb-4 text-center">
                        <div class="col-6">
                            <div class="p-3 border rounded-3 bg-light">
                                <h6 class="fw-bold mb-1">Grafik Pemakaian</h6>
                                <p class="small mb-0 text-muted">Melihat frekuensi penggunaan per unit kendaraan.</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 border rounded-3 bg-light">
                                <h6 class="fw-bold mb-1">Status Driver</h6>
                                <p class="small mb-0 text-muted">Monitoring ketersediaan pengemudi secara langsung.</p>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-info w-100 rounded-3 fw-bold text-white" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalBBM" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-4 shadow">
                <div class="modal-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-burn fa-3x text-success mb-3"></i>
                        <h4 class="fw-bold">Monitoring BBM Presisi</h4>
                    </div>
                    <p class="text-secondary text-center">Fitur khusus untuk mengontrol salah satu biaya operasional terbesar dalam industri pertambangan:</p>
                    <div class="p-4 bg-success-subtle rounded-4 mb-4">
                        <h6 class="fw-bold text-success mb-2">Siklus Monitoring:</h6>
                        <p class="small text-dark mb-0">Pencatatan <strong>KM Awal</strong> saat berangkat dan <strong>KM Akhir</strong> saat kembali untuk kalkulasi konsumsi bahan bakar yang akurat.</p>
                    </div>
                    <p class="small text-muted text-center italic">Memastikan transparansi biaya dan efisiensi energi pada setiap unit operasional.</p>
                    <button type="button" class="btn btn-success w-100 rounded-3 fw-bold" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center py-5 text-muted small">
        <div class="container">
            <hr>
            <p>&copy; 2025 PT SEKAWAN MEDIA INFORMATIKA. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>