<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-4">
                <h4 class="fw-800 text-dark">Account Settings</h4>
                <p class="text-muted small">Kelola informasi profil, keamanan kata sandi, dan privasi akun Anda.</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 border-start border-4 border-danger">
                    <div class="card-body p-4">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 bg-primary text-white p-2">
                    <div class="card-body text-center py-5">
                        <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 shadow" style="width: 80px; height: 80px; font-size: 2rem; font-weight: 800;">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
                        <p class="small opacity-75">{{ Auth::user()->email }}</p>
                        <span class="badge bg-white text-primary rounded-pill px-3">{{ ucfirst(Auth::user()->role) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>