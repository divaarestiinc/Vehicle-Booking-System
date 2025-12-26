<x-app-layout>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">Manajemen Personil</h4>
                <p class="text-muted small">Kelola hak akses dan status keaktifan staf operasional.</p>
            </div>
            <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="fas fa-user-plus me-1"></i> Tambah User
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4">
                <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4">
            <div class="table-responsive p-3">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr class="text-muted small">
                            <th>NAMA & EMAIL</th>
                            <th>ROLE / LEVEL</th>
                            <th>STATUS AKSES</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $user->name }}</div>
                                <div class="small text-muted">{{ $user->email }}</div>
                            </td>
                            <td>
                                <form action="{{ route('users.updateRole', $user->id) }}" method="POST">
                                    @csrf
                                    <select name="role" onchange="this.form.submit()" class="form-select form-select-sm border-0 bg-light rounded-pill px-3" style="width: 150px;">
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>ADMIN</option>
                                        <option value="approver" {{ $user->role == 'approver' ? 'selected' : '' }}>APPROVER</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                @if($user->is_active)
                                    <span class="badge bg-success-subtle text-success rounded-pill px-3">
                                        <i class="fas fa-check-circle me-1"></i> Aktif
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger rounded-pill px-3">
                                        <i class="fas fa-times-circle me-1"></i> Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-sm btn-light rounded-pill px-3 shadow-sm border" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </button>

                                    <form action="{{ route('users.toggle', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm {{ $user->is_active ? 'btn-outline-danger' : 'btn-success' }} rounded-pill px-3">
                                            {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach($users as $user)
    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <form action="{{ route('users.updateRole', $user->id) }}" method="POST">
                    @csrf
                    <div class="modal-header border-0 pb-0">
                        <h5 class="fw-bold text-dark px-2 mt-2">Detail Personil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                            <input type="text" class="form-control bg-light border-0 p-3" value="{{ $user->name }}" disabled>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold text-secondary">Email</label>
                            <input type="email" class="form-control bg-light border-0 p-3" value="{{ $user->email }}" disabled>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold text-secondary">Role Hak Akses</label>
                            <select name="role" class="form-select border-0 bg-light p-3 rounded-3">
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin (Pengelola)</option>
                                <option value="approver" {{ $user->role == 'approver' ? 'selected' : '' }}>Approver (Penyetuju)</option>
                            </select>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary p-3 rounded-3 fw-bold shadow-sm">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0 pb-0">
                        <h5 class="fw-bold text-dark px-2 mt-2">Registrasi Personil Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control border-0 bg-light p-3" placeholder="Masukkan nama" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold text-secondary">Email Perusahaan</label>
                            <input type="email" name="email" class="form-control border-0 bg-light p-3" placeholder="name@company.com" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold text-secondary">Role</label>
                            <select name="role" class="form-select border-0 bg-light p-3">
                                <option value="approver">Approver (Penyetuju)</option>
                                <option value="admin">Admin (Pengelola)</option>
                            </select>
                        </div>
                        <div class="mb-3 text-start">
                            <label class="form-label small fw-bold text-secondary">Password Awal</label>
                            <input type="password" name="password" class="form-control border-0 bg-light p-3" placeholder="Minimal 8 karakter" required>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary p-3 rounded-3 fw-bold shadow-sm">Daftarkan Personil</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>