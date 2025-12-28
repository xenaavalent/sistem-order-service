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
        Schema::create('service_orders', function (Blueprint $table) {
            $table->id();
            // Sesuaikan dengan nama tabel kamu 'customers' dan kolom 'customers_id'
            $table->foreignId('customers_id')->constrained('customers')->onDelete('cascade');
            
            // Menghubungkan ke tabel master layanan (services)
            $table->foreignId('service_id')->constrained('services')->onDelete('restrict');
            
            $table->date('service_date'); 
            
            // Kita tambah 'proses' agar dashboard pelanggan lebih informatif
            $table->enum('status', ['pending', 'proses', 'done'])->default('pending');
            
            // Gunakan bigInteger untuk nominal uang
            $table->bigInteger('total');
            
            $table->text('notes')->nullable(); // Tambahan catatan keluhan/sparepart
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_orders');
    }
};