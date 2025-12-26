<x-app-layout>
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white py-4 px-4 border-0">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold text-dark mb-1">Vehicle Reservation List</h5>
                    <p class="text-muted small mb-0">Pantau riwayat pemesanan dan monitoring konsumsi BBM armada.</p>
                </div>
                @if(Auth::user()->role == 'admin')
                <div class="d-flex gap-2">
                    <a href="{{ route('bookings.export') }}" class="btn btn-outline-success rounded-3 px-3">
                        <i class="fas fa-file-excel me-2"></i>Export Excel
                    </a>
                    <a href="{{ route('bookings.create') }}" class="btn btn-primary rounded-3 px-3 shadow-sm">
                        <i class="fas fa-plus me-2"></i>New Reservation
                    </a>
                </div>
                @endif
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-secondary small fw-bold">VEHICLE & LOCATION</th>
                            <th class="py-3 text-secondary small fw-bold">DRIVER & PERIOD</th>
                            <th class="py-3 text-secondary small fw-bold">FUEL USAGE</th>
                            <th class="py-3 text-secondary small fw-bold">STATUS</th>
                            <th class="pe-4 py-3 text-center text-secondary small fw-bold">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody class="border-top-0">
                        @foreach($bookings as $booking)
                        <tr>
                            <td class="ps-4 py-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-light p-2 rounded-3 me-3 text-primary">
                                        <i class="fas fa-truck-pickup fa-lg"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $booking->vehicle->name }}</div>
                                        <div class="text-muted extra-small" style="font-size: 0.75rem;">
                                            <i class="fas fa-map-marker-alt me-1"></i> {{ $booking->vehicle->location }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $booking->driver->name }}</div>
                                <div class="text-muted small text-truncate" style="max-width: 200px;">
                                    {{ \Carbon\Carbon::parse($booking->start_date)->format('d M') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}
                                </div>
                            </td>
                            <td>
                                @if(!is_null($booking->km_end))
                                    <div class="d-flex align-items-center text-info">
                                        <i class="fas fa-gas-pump me-2"></i>
                                        <span class="fw-bold">{{ number_format($booking->total_fuel_consumed, 2) }} L</span>
                                    </div>
                                    <small class="text-muted extra-small">Dist: {{ $booking->km_end - $booking->km_start }} KM</small>
                                @else
                                    <span class="text-muted small italic">N/A</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-warning-subtle text-warning border-warning',
                                        'level_1_approved' => 'bg-info-subtle text-info border-info',
                                        'approved' => 'bg-success-subtle text-success border-success',
                                        'completed' => 'bg-primary-subtle text-primary border-primary',
                                        'rejected' => 'bg-danger-subtle text-danger border-danger'
                                    ];
                                    $class = $statusClasses[$booking->status] ?? 'bg-secondary-subtle';
                                @endphp
                                <span class="badge {{ $class }} border px-3 py-2 rounded-pill fw-bold" style="font-size: 0.7rem;">
                                    <i class="fas fa-circle me-1 small"></i> {{ strtoupper(str_replace('_', ' ', $booking->status)) }}
                                </span>
                            </td>
                            <td class="pe-4 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    @if(Auth::user()->role == 'approver')
                                        @if(Auth::user()->id == $booking->approver_1_id && $booking->status == 'pending')
                                            <form action="{{ route('bookings.approve', $booking->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-primary rounded-3 px-3 fw-bold shadow-sm">Approve L1</button>
                                            </form>
                                        @elseif(Auth::user()->id == $booking->approver_2_id && $booking->status == 'level_1_approved')
                                            <form action="{{ route('bookings.approve', $booking->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-success rounded-3 px-3 fw-bold shadow-sm">Final Approve</button>
                                            </form>
                                        @endif
                                    @endif

                                    @if(Auth::user()->role == 'admin' && $booking->status == 'approved' && is_null($booking->km_end))
                                        <button class="btn btn-sm btn-outline-info rounded-3 px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#finishModal{{ $booking->id }}">
                                            <i class="fas fa-flag-checkered me-1"></i> Selesai
                                        </button>

                                        <div class="modal fade" id="finishModal{{ $booking->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 shadow-lg rounded-4 text-start">
                                                    <form action="{{ route('bookings.finish', $booking->id) }}" method="POST" class="p-4">
                                                        @csrf
                                                        <div class="d-flex align-items-center mb-4">
                                                            <div class="bg-info-subtle p-3 rounded-3 text-info me-3">
                                                                <i class="fas fa-gas-pump fa-lg"></i>
                                                            </div>
                                                            <div>
                                                                <h5 class="fw-bold mb-0">Input Kilometer Akhir</h5>
                                                                <small class="text-muted">Unit: {{ $booking->vehicle->name }}</small>
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label small fw-bold text-secondary">Kilometer Awal (KM)</label>
                                                            <input type="number" class="form-control bg-light border-0 p-3 rounded-3" value="{{ $booking->km_start }}" readonly>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="form-label small fw-bold text-dark">Kilometer Akhir (KM)</label>
                                                            <input type="number" name="km_end" class="form-control border-info p-3 rounded-3 shadow-sm" placeholder="Masukkan KM saat unit kembali" required autofocus>
                                                            <div class="form-text text-info">Sistem akan otomatis menghitung konsumsi BBM.</div>
                                                        </div>

                                                        <div class="d-flex justify-content-end gap-2 mt-4">
                                                            <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary rounded-3 px-4 fw-bold shadow-sm">Simpan Data</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!is_null($booking->km_end))
                                        <span class="text-muted small italic">Completed <i class="fas fa-check-circle text-success ms-1"></i></span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>