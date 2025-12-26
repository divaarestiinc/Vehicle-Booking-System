<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Grafik Pemakaian: Menghitung semua booking (termasuk yang sedang berjalan)
        $usageData = Booking::select('vehicle_id', DB::raw('count(*) as total'))
            ->groupBy('vehicle_id')
            ->with('vehicle')
            ->get();

        $labels = $usageData->map(function ($item) {
            return $item->vehicle ? $item->vehicle->name : 'Unknown';
        });
        $dataValues = $usageData->pluck('total');

        // 2. Grafik BBM: Mengambil data yang sudah memiliki nilai konsumsi BBM
        // Pastikan total_fuel_consumed tidak null agar bar muncul di grafik
        $fuelData = Booking::whereNotNull('total_fuel_consumed')
            ->select('vehicle_id', DB::raw('SUM(total_fuel_consumed) as total_fuel'))
            ->groupBy('vehicle_id')
            ->with('vehicle')
            ->get();

        $fuelLabels = $fuelData->map(function ($item) {
            return $item->vehicle ? $item->vehicle->name : 'Unknown';
        });
        $fuelValues = $fuelData->pluck('total_fuel');

        // 3. Log Aktivitas
        $recentActivities = ActivityLog::latest()->take(5)->get();

        // 4. Statistik Card: Sinkronisasi status
        $stats = [
            'total_vehicles' => Vehicle::count(),
            'total_drivers'  => Driver::count(),
            // Disetujui: Termasuk yang sudah 'approved' dan yang sudah 'completed'
            'approved_bookings' => Booking::whereIn('status', ['approved', 'completed'])->count(),
            'pending_bookings'  => Booking::where('status', 'pending')->count(),
        ];

        return view('dashboard', compact(
            'labels', 
            'dataValues', 
            'fuelLabels', 
            'fuelValues', 
            'recentActivities',
            'stats'
        ));
    }
}