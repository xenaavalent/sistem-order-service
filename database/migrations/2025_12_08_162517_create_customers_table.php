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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            
            // TAMBAHKAN BARIS INI:
            // Ini adalah kunci agar pelanggan bisa punya akun login
            $table->foreignId('user_id')->after('id')->constrained('users')->onDelete('cascade');
            
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('plate_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};