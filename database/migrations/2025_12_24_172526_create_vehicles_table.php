<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Contoh: Toyota Hilux
        $table->enum('type', ['person', 'cargo']); // Angkutan orang/barang [cite: 5]
        $table->enum('ownership', ['owned', 'rented']); // Milik perusahaan/sewa [cite: 6]
        $table->string('location'); // Lokasi: Kantor Pusat, Cabang, atau 6 Tambang [cite: 4]
        $table->integer('fuel_consumption'); // Monitoring BBM [cite: 8]
        $table->date('last_service'); // Jadwal service [cite: 8]
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
