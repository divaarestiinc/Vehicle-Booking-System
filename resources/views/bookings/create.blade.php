<x-app-layout>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-4 px-4 border-0">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary-subtle p-2 rounded-3 me-3 text-primary">
                            <i class="fas fa-plus-square fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Create New Reservation</h5>
                            <p class="text-muted small mb-0">Lengkapi formulir untuk pengajuan armada dan pencatatan awal monitoring BBM.</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-4">
                            <div class="col-md-12">
                                <label class="form-label fw-bold small text-secondary">Vehicle Unit & Current Location</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="fas fa-truck-moving text-muted"></i></span>
                                    <select name="vehicle_id" id="vehicle_id" class="form-select border-0 bg-light p-3 rounded-end-3" required>
                                        <option value="" disabled selected>Select vehicle unit...</option>
                                        @foreach($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}">
                                                {{ $vehicle->name }} — {{ $vehicle->location }} ({{ ucfirst($vehicle->ownership) }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-primary">Odometer Start (KM)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-primary-subtle border-0"><i class="fas fa-tachometer-alt text-primary"></i></span>
                                    <input type="number" name="km_start" class="form-control border-0 bg-light p-3 rounded-end-3" 
                                           placeholder="Masukkan KM awal saat ini" required min="0">
                                </div>
                                <div class="form-text extra-small">KM awal digunakan sebagai basis perhitungan konsumsi BBM nantinya.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-secondary">Assigned Driver</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="fas fa-user-tie text-muted"></i></span>
                                    <select name="driver_id" class="form-select border-0 bg-light p-3 rounded-end-3" required>
                                        <option value="" disabled selected>Select driver...</option>
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-secondary">Start Date</label>
                                <input type="date" name="start_date" class="form-control border-0 bg-light p-3 rounded-3 shadow-sm" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-secondary">End Date</label>
                                <input type="date" name="end_date" class="form-control border-0 bg-light p-3 rounded-3 shadow-sm" required>
                            </div>

                            <div class="col-12 mt-4">
                                <hr class="opacity-25">
                                <h6 class="fw-bold text-dark small mb-0"><i class="fas fa-user-check me-2 text-info"></i>Multi-level Approval Requirement</h6>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-secondary">Approver Level 1 (Manager)</label>
                                <select name="approver_1_id" class="form-select border-0 bg-light p-3 rounded-3" required>
                                    <option value="" disabled selected>Select Manager...</option>
                                    @foreach($approvers as $app)
                                        <option value="{{ $app->id }}">{{ $app->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-secondary">Approver Level 2 (Head Office)</label>
                                <select name="approver_2_id" class="form-select border-0 bg-light p-3 rounded-3" required>
                                    <option value="" disabled selected>Select Head Office...</option>
                                    @foreach($approvers as $app)
                                        <option value="{{ $app->id }}">{{ $app->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-5 d-flex gap-2 justify-content-end">
                            <a href="{{ route('bookings.index') }}" class="btn btn-light px-4 py-2 rounded-3 text-secondary fw-bold">Cancel</a>
                            <button type="submit" class="btn btn-primary px-5 py-2 rounded-3 fw-bold shadow-sm">
                                Submit & Log KM <i class="fas fa-paper-plane ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>