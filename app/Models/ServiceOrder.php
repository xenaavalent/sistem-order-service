<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    use HasFactory;

    protected $fillable = [
    'customers_id',
    'service_id',
    'service_date',
    'status',
    'total',
    'plate_number', // Ini yang membuat data kendaraan mau masuk ke database
];

    public function customer()
    {
        return $this->belongsTo(customers::class, 'customers_id');
    }

    public function service()
    {
        return $this->belongsTo(Services::class, 'service_id');
    }
}