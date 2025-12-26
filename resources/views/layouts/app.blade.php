<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sekawan Fleet | Enterprise Solution</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --sidebar-bg: #0f172a; /* Slate 900 */
            --accent-color: #0ea5e9; /* Sky 500 */
            --main-bg: #f8fafc;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--main-bg);
            color: #1e293b;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            background-color: var(--sidebar-bg);
            color: white;
            padding: 2rem 1.5rem;
            transition: all 0.3s ease;
            z-index: 1040; /* Sedikit diturunkan agar modal backdrop (1050) bisa menutupinya */
        }

        .brand-area {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 3rem;
            padding-left: 0.5rem;
        }

        .brand-logo-small {
            width: 40px;
            height: 40px;
            background: var(--accent-color);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.4);
        }

        .nav-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.8rem 1rem;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 0.5rem;
            transition: all 0.2s;
        }

        .nav-link i {
            width: 20px;
            text-align: center;
        }

        .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.05);
        }

        .nav-link.active {
            color: white;
            background: var(--accent-color);
            font-weight: 600;
            box-shadow: 0 10px 15px -3px rgba(14, 165, 233, 0.3);
        }

        /* Main Content Area */
        .main-wrapper {
            margin-left: 280px;
            min-height: 100vh;
            padding: 2rem 3rem;
        }

        /* Top Header */
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
        }

        /* User Profile & Logout */
        .user-profile-box {
            background: white;
            padding: 0.5rem 1rem;
            border-radius: 100px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #f1f5f9;
        }

        .avatar-placeholder {
            width: 35px;
            height: 35px;
            background: #e2e8f0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #475569;
        }

        .btn-logout {
            border: none;
            background: #fee2e2;
            color: #ef4444;
            padding: 0.5rem 1rem;
            border-radius: 100px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: 0.2s;
        }

        .btn-logout:hover { background: #fecaca; }

        /* FIX UNTUK MODAL AGAR TIDAK BERANTAKAN */
        .modal { z-index: 1060 !important; }
        .modal-backdrop { z-index: 1050 !important; }
        
        /* Menghapus overflow tersembunyi pada wrapper saat modal dibuka agar tidak terpotong */
        body.modal-open { overflow: hidden; padding-right: 0 !important; }

        .modal-content {
            border-radius: 1.25rem !important;
            border: none !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
        }

        /* Memastikan input modal tidak "over-styled" */
        .modal-body .form-control {
            background-color: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            padding: 0.75rem 1rem !important;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .main-wrapper { margin-left: 0; padding: 1.5rem; }
        }
    </style>
</head>
<body>

    <aside class="sidebar shadow-lg">
        <div class="brand-area text-decoration-none text-white">
            <div class="brand-logo-small">
                <i class="fas fa-truck-monster"></i>
            </div>
            <h5 class="mb-0 fw-bold tracking-tight">Sekawan<span class="text-info">Fleet</span></h5>
        </div>

        <div class="nav-label">Main Menu</div>
        <nav class="nav flex-column">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('bookings.index') }}" class="nav-link {{ request()->routeIs('bookings.index') ? 'active' : '' }}">
                <i class="fas fa-list-ul"></i>
                <span>Reservation List</span>
            </a>
            
            @if(Auth::user()->role == 'admin')
                <div class="nav-label mt-4">Administrative</div>
                <a href="{{ route('bookings.create') }}" class="nav-link {{ request()->routeIs('bookings.create') ? 'active' : '' }}">
                    <i class="fas fa-plus-square"></i>
                    <span>Create Booking</span>
                </a>
                <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="fas fa-users-cog"></i>
                    <span>Manage Users</span>
                </a>
            @endif

            <div class="nav-label mt-4">Settings</div>
            <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                <i class="fas fa-user-circle"></i>
                <span>My Profile</span>
            </a>
        </nav>
    </aside>

    <main class="main-wrapper">
        <header class="top-header">
            <div>
                <h6 class="text-muted mb-0 small uppercase fw-bold">System Information</h6>
                <small class="text-secondary">Fleet Operational & Management</small>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <div class="user-profile-box">
                    <div class="avatar-placeholder">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="d-none d-sm-block">
                        <div class="fw-bold small">{{ Auth::user()->name }}</div>
                        <div class="text-muted" style="font-size: 0.7rem;">{{ strtoupper(Auth::user()->role) }}</div>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout" title="Log Out">
                        <i class="fas fa-power-off"></i>
                    </button>
                </form>
            </div>
        </header>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 p-3 mb-4">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm rounded-4 p-3 mb-4">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            </div>
        @endif

        <div class="content-area">
            {{ $slot }}
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>