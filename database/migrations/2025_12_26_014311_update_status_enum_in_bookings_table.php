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
            DB::statement("ALTER TABLE bookings MODIFY COLUMN status ENUM('pending', 'level_1_approved', 'approved', 'completed', 'rejected') DEFAULT 'pending'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Mengembalikan ke status semula jika diperlukan
            DB::statement("ALTER TABLE bookings MODIFY COLUMN status ENUM('pending', 'level_1_approved', 'approved', 'rejected') DEFAULT 'pending'");
        });
    }
};
