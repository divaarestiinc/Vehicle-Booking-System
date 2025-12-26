<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController; // Pastikan ini diimpor
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Grup Middleware Auth: Semua yang sudah login bisa masuk sini
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard & Profile (Bisa diakses oleh semua role)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Daftar Pemesanan (Dilihat oleh Admin & Approver)
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');

    // ==========================================
    // KHUSUS ROLE: ADMIN
    // ==========================================
    Route::middleware(['role:admin'])->group(function () {
        // Reservasi & Export
        Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
        Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
        Route::get('/bookings/export', [BookingController::class, 'exportExcel'])->name('bookings.export');
        
        // Monitoring BBM
        Route::post('/bookings/{id}/finish', [BookingController::class, 'finishBooking'])->name('bookings.finish');

        // Manajemen User (CRUD Role & Status)
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::post('/users/{id}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
        Route::post('/users/{id}/toggle', [UserController::class, 'toggleStatus'])->name('users.toggle');
    });

    // ==========================================
    // KHUSUS ROLE: APPROVER (PENYETUJU)
    // ==========================================
    Route::middleware(['role:approver'])->group(function () {
        // Persetujuan berjenjang Level 1 & 2
        Route::post('/bookings/{id}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
    });
});

require __DIR__.'/auth.php';