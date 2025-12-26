<section>
    <header class="mb-4">
        <h6 class="fw-bold text-danger"><i class="fas fa-exclamation-triangle me-2"></i>Delete Account</h6>
        <p class="text-muted small mb-0">Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen.</p>
    </header>

    <button type="button" class="btn btn-outline-danger fw-bold rounded-3" data-bs-toggle="modal" data-bs-target="#confirmUserDeletion">
        Delete Account Permanently
    </button>

    <div class="modal fade" id="confirmUserDeletion" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <form method="post" action="{{ route('profile.destroy') }}" class="p-4">
                    @csrf
                    @method('delete')
                    
                    <h5 class="fw-bold text-dark">Are you sure?</h5>
                    <p class="text-muted small">Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun secara permanen.</p>

                    <div class="mb-4">
                        <input type="password" name="password" class="form-control bg-light border-0 p-3 rounded-3" placeholder="Password Confirmation">
                        @error('password', 'userDeletion') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger rounded-3 px-4 fw-bold">Delete My Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>