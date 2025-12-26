<section>
    <header class="mb-4">
        <h6 class="fw-bold text-dark"><i class="fas fa-user-circle me-2 text-primary"></i>Profile Information</h6>
        <p class="text-muted small mb-0">Perbarui nama dan alamat email akun Anda.</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label class="form-label small fw-bold text-secondary">Full Name</label>
            <input type="text" name="name" class="form-control bg-light border-0 p-3 rounded-3" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="form-label small fw-bold text-secondary">Email Address</label>
            <input type="email" name="email" class="form-control bg-light border-0 p-3 rounded-3" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary px-4 fw-bold rounded-3">Save Changes</button>
            @if (session('status') === 'profile-updated')
                <span class="text-success small animate__animated animate__fadeOut animate__delay-2s"><i class="fas fa-check-circle me-1"></i> Saved.</span>
            @endif
        </div>
    </form>
</section>