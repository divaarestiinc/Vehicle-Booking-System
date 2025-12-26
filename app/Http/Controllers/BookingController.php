<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\User;
use App\Models\ActivityLog;
use App\Exports\BookingsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Menampilkan daftar pemesanan kendaraan
     */
    public function index()
    {
        // Menggunakan eager loading untuk performa maksimal
        $bookings = Booking::with(['vehicle', 'driver', 'admin', 'approver1', 'approver2'])
                            ->orderBy('created_at', 'desc')
                            ->get();
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Menampilkan form pemesanan kendaraan
     */
    public function create()
    {
        $vehicles = Vehicle::all(); 
        $drivers = Driver::where('status', true)->get();
        $approvers = User::where('role', 'approver')->get();

        return view('bookings.create', compact('vehicles', 'drivers', 'approvers'));
    }

    /**
     * Menyimpan data pemesanan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id'    => 'required|exists:vehicles,id',
            'driver_id'     => 'required|exists:drivers,id',
            'approver_1_id' => 'required|exists:users,id',
            'approver_2_id' => 'required|exists:users,id|different:approver_1_id', 
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date',
            'km_start'      => 'required|numeric|min:0', 
        ]);

        $booking = Booking::create([
            'vehicle_id'    => $request->vehicle_id,
            'driver_id'     => $request->driver_id,
            'admin_id'      => Auth::id(),
            'approver_1_id' => $request->approver_1_id,
            'approver_2_id' => $request->approver_2_id,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'km_start'      => $request->km_start, 
            'status'        => 'pending',
        ]);

        // Mencatat aktivitas ke database
        $this->logActivity("Membuat pemesanan kendaraan {$booking->vehicle->name} (KM Awal: {$request->km_start})");

        return redirect()->route('bookings.index')->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * Logika Persetujuan Berjenjang (Level 1 & 2)
     */
    public function approve(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $user = Auth::user();

        // Level 1: Persetujuan pertama
        if ($user->id == $booking->approver_1_id && $booking->status == 'pending') {
            $booking->update(['status' => 'level_1_approved']);
            $this->logActivity("Persetujuan Level 1 oleh {$user->name} untuk Booking #{$booking->id}"); 
            return redirect()->back()->with('success', 'Persetujuan level 1 berhasil.');
        } 
        
        // Level 2: Persetujuan kedua
        if ($user->id == $booking->approver_2_id && $booking->status == 'level_1_approved') {
            $booking->update(['status' => 'approved']);
            $this->logActivity("Persetujuan Final (Level 2) oleh {$user->name} untuk Booking #{$booking->id}"); 
            return redirect()->back()->with('success', 'Persetujuan final berhasil.');
        }

        return redirect()->back()->with('error', 'Otoritas tidak sah atau status booking tidak sesuai.');
    }

    /**
     * Menyelesaikan pemesanan dan menghitung konsumsi BBM
     */
    public function finishBooking(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        // Validasi agar KM End tidak lebih kecil dari KM Start yang ada di database
        $request->validate([
            'km_end' => 'required|numeric|gt:' . $booking->km_start,
        ]);

        $vehicle = $booking->vehicle;
        
        // Proteksi pembagian nol jika data fuel_consumption di tabel vehicles kosong atau 0
        $consumptionRate = ($vehicle->fuel_consumption > 0) ? $vehicle->fuel_consumption : 1;
        
        $distance = $request->km_end - $booking->km_start;
        $fuelUsed = $distance / $consumptionRate;

        // Update data ke database
        $booking->update([
            'km_end' => $request->km_end,
            'total_fuel_consumed' => $fuelUsed,
            'status' => 'completed' 
        ]);

        // Catat aktivitas penyelesaian agar muncul di grafik Dashboard
        $this->logActivity("Selesai: Unit {$vehicle->name} menempuh {$distance} KM (BBM: " . number_format($fuelUsed, 2) . " L)");

        return back()->with('success', 'Konsumsi BBM berhasil dihitung: ' . number_format($fuelUsed, 2) . ' Liter');
    }

    /**
     * Export Excel Laporan Periodik
     */
    public function exportExcel()
    {
        $this->logActivity("Mengunduh laporan Excel oleh " . Auth::user()->name); 
        return Excel::download(new BookingsExport, 'laporan-pemesanan-' . date('Y-m-d') . '.xlsx');
    }

    /**
     * Helper Log Aplikasi
     */
    private function logActivity($description) 
    {
        ActivityLog::create([
            'user_id' => Auth::id() ?? 0,
            'user_name' => Auth::user()->name ?? 'System',
            'description' => $description
        ]);
    }
}