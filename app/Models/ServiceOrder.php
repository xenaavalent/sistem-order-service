<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    // Pastikan semua kolom ini bisa diisi
    protected $fillable = [
        'user_id', 
        'plate_number', 
        'service_id', 
        'total', 
        'status', 
        'service_date'
    ];

    /**
     * Relasi ke Customer
     * Menghubungkan customer_id (ServiceOrder) ke id (Customer)
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }
}