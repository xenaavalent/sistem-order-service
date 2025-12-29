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
    Schema::table('service_orders', function (Blueprint $table) {
        // Mengubah kolom menjadi string agar bisa menampung "1, 2, 3"
        $table->string('service_id')->change();
    });
}

public function down(): void
{
    Schema::table('service_orders', function (Blueprint $table) {
        $table->integer('service_id')->change();
    });
}
};
