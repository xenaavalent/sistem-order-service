<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers'; // Nama tabel di database Anda

    protected $fillable = [
        'user_id', 
        'name', 
        'phone', 
        'vehicle_brand', 
        'vehicle_type', 
        'plate_number'
    ];

    public function serviceOrders()
    {
        // Pastikan foreign key di tabel service_orders adalah customer_id
        return $this->hasMany(ServiceOrder::class, 'user_id');
    }
}