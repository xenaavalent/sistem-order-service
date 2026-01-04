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
        Schema::create('order_service', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel Order Utama
            $table->foreignId('service_order_id')
                  ->constrained('service_orders')
                  ->onDelete('cascade');

            // Relasi ke tabel Layanan/Jasa
            $table->foreignId('service_id')
                  ->constrained('services')
                  ->onDelete('cascade');

            /**
             * Menyimpan harga layanan pada saat booking 
             * Menggunakan decimal 15, 2 agar bisa menampung angka hingga ratusan miliar
             */
            $table->decimal('price', 15, 2); 

            $table->timestamps();

            // Optimasi: Agar pencarian data di tabel pivot lebih cepat
            $table->index(['service_order_id', 'service_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_service');
    }
};