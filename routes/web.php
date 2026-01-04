<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceOrderController;
use App\Http\Controllers\VehicleController;

// 1. Redirect Root ke Dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// 2. Semua Route yang butuh Login
Route::middleware(['auth'])->group(function () {
    
    // Dashboard (Admin & Customer)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // KENDARAAN (Admin & Customer)
    Route::resource('vehicles', VehicleController::class);

    // ORDER SERVIS (Admin & Customer)
    // Kita tetap pakai resource, tapi kita tambahkan manual route 'riwayat.index' 
    // agar sinkron dengan file Blade kamu.
    Route::get('/orders/history', [ServiceOrderController::class, 'index'])->name('riwayat.index');
    Route::resource('orders', ServiceOrderController::class);

    // KHUSUS ADMIN (Master Data)
    Route::middleware('role:admin')->group(function () {
        Route::resource('services', ServicesController::class);
        Route::resource('customers', CustomersController::class);
    });

    // PROFILE (Bawaan Laravel)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';