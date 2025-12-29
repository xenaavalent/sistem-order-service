<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceOrderController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Filter Khusus Admin
    Route::middleware('role:admin')->group(function () {
        // Menggunakan resource agar otomatis mendukung index, create, store, dll
        Route::resource('services', ServicesController::class);
        Route::resource('customers', CustomersController::class);
        Route::resource('orders', ServiceOrderController::class);
        
        Route::patch('orders/{order}/status', [ServiceOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';