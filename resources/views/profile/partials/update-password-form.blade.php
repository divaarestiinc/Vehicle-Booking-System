<section>
    <header class="mb-4">
        <h6 class="fw-bold text-dark"><i class="fas fa-key me-2 text-primary"></i>Update Password</h6>
        <p class="text-muted small mb-0">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Current Password</label>
            <input type="password" name="current_password" class="form-control bg-light border-0 p-3 rounded-3" autocomplete="current-password">
            @error('current_password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">New Password</label>
            <input type="password" name="password" class="form-control bg-light border-0 p-3 rounded-3" autocomplete="new-password">
            @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="form-label small fw-bold text-secondary">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control bg-light border-0 p-3 rounded-3" autocomplete="new-password">
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary px-4 fw-bold rounded-3">Update Password</button>
            @if (session('status') === 'password-updated')
                <span class="text-success small"><i class="fas fa-check-circle me-1"></i> Updated.</span>
            @endif
        </div>
    </form>
</section>