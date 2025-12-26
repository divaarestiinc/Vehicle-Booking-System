<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'vehicle_id',
        'driver_id',
        'admin_id',
        'approver_1_id',
        'approver_2_id',
        'start_date',
        'end_date',
        'status',
        'km_start',
        'km_end',
        'total_fuel_consumed',
    ];

    // Relasi untuk Dashboard & Laporan [cite: 17, 18]
    public function vehicle() { return $this->belongsTo(Vehicle::class); }
    public function driver() { return $this->belongsTo(Driver::class); }
    public function admin() { return $this->belongsTo(User::class, 'admin_id'); }
    public function approver1() { return $this->belongsTo(User::class, 'approver_1_id'); }
    public function approver2() { return $this->belongsTo(User::class, 'approver_2_id'); }
}