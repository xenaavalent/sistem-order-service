<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            // Relasi ke User/Customer
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            
            // Relasi ke Kendaraan (Penting agar data terhubung ke Garasi)
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            
            // Snapshot Data (Agar jika motor dihapus/diedit, riwayat servis lama tetap akurat)
            $table->string('vehicle_name'); 
            $table->string('plate_number');
            
            // Status & Pembayaran
            // Kita gunakan string saja agar lebih fleksibel dibanding ENUM jika ada perubahan status di masa depan
            $table->string('status')->default('PENDING'); 
            $table->decimal('total_price', 15, 2)->default(0);
            
            $table->date('service_date')->nullable(); // Tanggal pengerjaan
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_orders');
    }
};