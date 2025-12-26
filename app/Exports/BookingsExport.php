<?php
namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BookingsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * Mengambil data pemesanan beserta relasi kendaraan dan driver [cite: 18]
    */
    public function collection()
    {
        return Booking::with(['vehicle', 'driver', 'admin'])->get();
    }

    /**
    * Menentukan Judul Kolom di Excel [cite: 18]
    */
    public function headings(): array
    {
        return [
            'ID Booking',
            'Nama Kendaraan',
            'Driver',
            'Admin Pemesan',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Status Persetujuan'
        ];
    }

    /**
    * Memetakan data ke kolom Excel [cite: 18]
    */
    public function map($booking): array
    {
        return [
            $booking->id,
            $booking->vehicle->name,
            $booking->driver->name,
            $booking->admin->name,
            $booking->start_date,
            $booking->end_date,
            $booking->status,
        ];
    }
}