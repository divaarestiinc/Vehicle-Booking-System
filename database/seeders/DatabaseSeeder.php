<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Driver;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat User (Admin dan Penyetuju) 
        User::create([
            'name' => 'Admin Sekawan',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Manager Operasional (Lvl 1)',
            'email' => 'boss1@mail.com',
            'password' => Hash::make('password'),
            'role' => 'approver'
        ]);

        User::create([
            'name' => 'Head of Region (Lvl 2)',
            'email' => 'boss2@mail.com',
            'password' => Hash::make('password'),
            'role' => 'approver'
        ]);

        // 2. Data 10 Kendaraan (Milik Sendiri & Sewa, Orang & Barang) 
        $vehicles = [
            ['name' => 'Toyota Hilux 4x4', 'type' => 'cargo', 'ownership' => 'owned', 'location' => 'Tambang A', 'fuel' => 12],
            ['name' => 'Mitsubishi Triton', 'type' => 'cargo', 'ownership' => 'owned', 'location' => 'Tambang B', 'fuel' => 11],
            ['name' => 'Isuzu Elf Bus', 'type' => 'person', 'ownership' => 'rented', 'location' => 'Kantor Pusat', 'fuel' => 8],
            ['name' => 'Toyota Avanza', 'type' => 'person', 'ownership' => 'owned', 'location' => 'Kantor Cabang', 'fuel' => 15],
            ['name' => 'Hino Ranger Truck', 'type' => 'cargo', 'ownership' => 'owned', 'location' => 'Tambang C', 'fuel' => 5],
            ['name' => 'Toyota Coaster', 'type' => 'person', 'ownership' => 'rented', 'location' => 'Tambang D', 'fuel' => 7],
            ['name' => 'Scania Hauler', 'type' => 'cargo', 'ownership' => 'owned', 'location' => 'Tambang E', 'fuel' => 3],
            ['name' => 'Nissan Navara', 'type' => 'cargo', 'ownership' => 'rented', 'location' => 'Tambang F', 'fuel' => 10],
            ['name' => 'Ford Ranger', 'type' => 'cargo', 'ownership' => 'owned', 'location' => 'Tambang A', 'fuel' => 12],
            ['name' => 'Hiace Commuter', 'type' => 'person', 'ownership' => 'rented', 'location' => 'Kantor Pusat', 'fuel' => 9],
        ];

        foreach ($vehicles as $v) {
            Vehicle::create([
                'name' => $v['name'],
                'type' => $v['type'],
                'ownership' => $v['ownership'],
                'location' => $v['location'],
                'fuel_consumption' => $v['fuel'],
                'last_service' => now()->subMonths(rand(1, 6)),
            ]);
        }

        // 3. Data 10 Driver
        $drivers = [
            ['name' => 'Budi Santoso', 'phone' => '081234567890'],
            ['name' => 'Agus Prayogo', 'phone' => '081234567891'],
            ['name' => 'Eko Wijaya', 'phone' => '081234567892'],
            ['name' => 'Slamet Riyadi', 'phone' => '081234567893'],
            ['name' => 'Andi Hermawan', 'phone' => '081234567894'],
            ['name' => 'Rully Hidayat', 'phone' => '081234567895'],
            ['name' => 'Dedi Kurniawan', 'phone' => '081234567896'],
            ['name' => 'Iwan Setiawan', 'phone' => '081234567897'],
            ['name' => 'Fajar Nugroho', 'phone' => '081234567898'],
            ['name' => 'Hendra Saputra', 'phone' => '081234567899'],
        ];

        foreach ($drivers as $d) {
            Driver::create([
                'name' => $d['name'],
                'phone' => $d['phone'],
                'status' => true
            ]);
        }
    }
}