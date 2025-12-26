<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Sekawan Fleet System</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(rgba(26, 42, 58, 0.8), rgba(26, 42, 58, 0.8)), 
                        url('https://images.unsplash.com/photo-1580519542036-c47de6196ba5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
            width: 100%;
            max-width: 450px;
            padding: 40px;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .brand-logo {
            width: 60px;
            height: 60px;
            background: #00d2ff;
            color: white;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin: 0 auto 20px;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #ddd;
        }
        .btn-login {
            background: #1a2a3a;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 700;
            width: 100%;
            transition: 0.3s;
        }
        .btn-login:hover {
            background: #00d2ff;
            color: white;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<div class="login-card animate__animated animate__fadeIn">
    <div class="text-center">
        <div class="brand-logo shadow-lg">
            <i class="fas fa-truck-monster"></i>
        </div>
        <h4 class="fw-bold text-dark">Welcome Back</h4>
        <p class="text-muted small mb-4">Fleet Monitoring & Reservation System</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success border-0 shadow-sm small mb-4" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label small fw-bold text-secondary">Email Address</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted small"></i></span>
                <input id="email" 
                       type="email" 
                       name="email" 
                       class="form-control border-start-0 @error('email') is-invalid @enderror" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       placeholder="name@company.com">
            </div>
            @error('email')
                <div class="text-danger extra-small mt-1 fw-bold" style="font-size: 0.75rem;">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label small fw-bold text-secondary">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted small"></i></span>
                <input id="password" 
                       type="password" 
                       name="password" 
                       class="form-control border-start-0 @error('password') is-invalid @enderror" 
                       required 
                       autocomplete="current-password" 
                       placeholder="••••••••">
            </div>
            @error('password')
                <div class="text-danger extra-small mt-1 fw-bold" style="font-size: 0.75rem;">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label small text-secondary">Remember me</label>
            </div>
            @if (Route::has('password.request'))
                <a class="text-decoration-none small fw-bold text-info" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <button type="submit" class="btn btn-login shadow-sm">
            Sign In <i class="fas fa-sign-in-alt ms-2"></i>
        </button>
    </form>

    <div class="mt-4 text-center">
        <p class="small text-muted mb-0">Don't have an account? <br>
            <span class="text-dark fw-bold">
                <i class="fas fa-user-shield me-1"></i> Contact Administrator
            </span>
        </p>
    </div>
</div>

</body>
</html>