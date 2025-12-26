<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sekawan Fleet') }}</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            :root {
                --primary-dark: #1a2a3a;
                --accent-blue: #00d2ff;
            }
            body {
                font-family: 'Inter', sans-serif;
                background-color: #f3f4f6; /* Warna latar belakang soft */
                color: #1f2937;
            }
            .auth-wrapper {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem;
            }
            .auth-card {
                width: 100%;
                max-width: 450px; /* Ukuran maksimal container auth */
                background: white;
                border: none;
                border-radius: 1.25rem; /* Corner membulat profesional */
                box-shadow: 0 10px 25px rgba(0,0,0,0.05);
                overflow: hidden;
            }
            .auth-logo {
                font-size: 2.5rem;
                color: var(--primary-dark);
                margin-bottom: 1.5rem;
                transition: 0.3s;
            }
            .auth-logo:hover {
                color: var(--accent-blue);
            }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="auth-wrapper">
            <div class="text-center w-100">
                <div class="mb-4">
                    <a href="/" class="text-decoration-none">
                        <i class="fas fa-truck-monster auth-logo"></i>
                        <h4 class="fw-800 text-dark mb-0">Sekawan<span class="text-primary">Fleet</span></h4>
                    </a>
                </div>

                <div class="auth-card mx-auto text-start">
                    <div class="p-4 p-md-5">
                        {{ $slot }}
                    </div>
                </div>

                <div class="mt-4 text-muted small">
                    &copy; {{ date('Y') }} PT SEKAWAN MEDIA INFORMATIKA.
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>