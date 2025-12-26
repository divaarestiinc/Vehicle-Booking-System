<x-app-layout>
    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-800 text-dark mb-1">Operational Dashboard</h4>
                <p class="text-muted small">Pantau status armada dan statistik pemesanan kendaraan secara real-time.</p>
            </div>
            <div class="d-flex gap-2">
                <span class="badge bg-white text-dark shadow-sm p-2 px-3 border">
                    <i class="fas fa-calendar-alt text-primary me-2"></i> {{ now()->format('d F Y') }}
                </span>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="card-body p-4 border-start border-4 border-primary">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted small fw-bold text-uppercase mb-1">Total Armada</h6>
                                <h3 class="fw-bold mb-0">{{ $stats['total_vehicles'] }}</h3>
                            </div>
                            <div class="bg-primary-subtle p-3 rounded-3 text-primary">
                                <i class="fas fa-truck-moving fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="card-body p-4 border-start border-4 border-success">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted small fw-bold text-uppercase mb-1">Disetujui</h6>
                                <h3 class="fw-bold mb-0">{{ $stats['approved_bookings'] }}</h3>
                            </div>
                            <div class="bg-success-subtle p-3 rounded-3 text-success">
                                <i class="fas fa-check-double fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="card-body p-4 border-start border-4 border-warning">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted small fw-bold text-uppercase mb-1">Pending</h6>
                                <h3 class="fw-bold mb-0">{{ $stats['pending_bookings'] }}</h3>
                            </div>
                            <div class="bg-warning-subtle p-3 rounded-3 text-warning">
                                <i class="fas fa-hourglass-half fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="card-body p-4 border-start border-4 border-info">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted small fw-bold text-uppercase mb-1">Total Driver</h6>
                                <h3 class="fw-bold mb-0">{{ $stats['total_drivers'] }}</h3>
                            </div>
                            <div class="bg-info-subtle p-3 rounded-3 text-info">
                                <i class="fas fa-user-shield fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold mb-0 text-dark">Grafik Frekuensi Penggunaan Kendaraan</h6>
                    </div>
                    <div class="card-body p-4">
                        <div style="height: 300px;">
                            <canvas id="usageChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="fw-bold mb-0 text-dark">Estimasi Konsumsi BBM (Liter)</h6>
                    </div>
                    <div class="card-body p-4">
                        <div style="height: 300px;">
                            <canvas id="fuelChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-0">
                        <h6 class="fw-bold mb-0 text-dark">Aktivitas Terakhir</h6>
                        <i class="fas fa-history text-muted"></i>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse($recentActivities as $log)
                                <div class="list-group-item border-0 p-3">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 mt-1">
                                            <i class="fas {{ str_contains($log->description, 'Selesai') ? 'fa-gas-pump text-success' : (str_contains($log->description, 'Approve') ? 'fa-check-circle text-info' : 'fa-circle text-primary') }} fa-xs"></i>
                                        </div>
                                        <div class="ms-3">
                                            <p class="mb-0 small fw-bold text-dark">{{ $log->description }}</p>
                                            <small class="text-muted">Oleh: {{ $log->user_name }}</small>
                                            <div class="text-muted extra-small mt-1" style="font-size: 10px;">
                                                <i class="far fa-clock me-1"></i> {{ $log->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-4 text-center">
                                    <small class="text-muted italic">Belum ada aktivitas tercatat.</small>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 text-center pb-4">
                        <a href="{{ route('bookings.index') }}" class="small text-decoration-none fw-bold">Lihat Semua Aktivitas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- Usage Chart (Bar) ---
            const usageCtx = document.getElementById('usageChart').getContext('2d');
            new Chart(usageCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                        label: 'Total Pemesanan',
                        data: {!! json_encode($dataValues) !!},
                        backgroundColor: '#0ea5e9',
                        borderRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
                }
            });

            // --- Fuel Chart (Horizontal Bar) ---
            const fuelCtx = document.getElementById('fuelChart').getContext('2d');
            new Chart(fuelCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($fuelLabels) !!},
                    datasets: [{
                        label: 'Konsumsi (Liter)',
                        data: {!! json_encode($fuelValues) !!},
                        backgroundColor: '#10b981',
                        borderRadius: 8,
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } }
                }
            });
        });
    </script>
</x-app-layout>