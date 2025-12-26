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
        Schema::table('bookings', function (Blueprint $table) {
            // Menambahkan kolom untuk melengkapi fitur monitoring BBM
        $table->integer('km_start')->default(0);
        $table->integer('km_end')->nullable();
        $table->decimal('total_fuel_consumed', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['km_start', 'km_end', 'total_fuel_consumed']);
        });
    }
};
