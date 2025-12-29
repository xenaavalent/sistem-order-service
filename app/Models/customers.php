<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara manual karena kamu menggunakan nama 'customers'
    protected $table = 'customers';

    protected $fillable = [
    'name', 
    'phone', 
    'address', 
    'plate_number', 
    'vehicle_brand', // Tambahan baru
    'vehicle_type'   // Tambahan baru
];

    /**
     * Relasi balik ke User
     * Artinya: Satu data pelanggan ini dimiliki oleh satu User (akun login)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke ServiceOrder
     * Artinya: Satu pelanggan bisa punya banyak riwayat order servis
     */
    public function serviceOrders()
    {
        return $this->hasMany(ServiceOrder::class, 'customers_id');
    }
}