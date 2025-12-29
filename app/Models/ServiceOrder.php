<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'customers_id',
        'plate_number',
        'service_id',
        'service_date',
        'status',
        'total',
    ];

    // Relasi untuk memanggil Nama Pelanggan
    public function customer()
    {
        return $this->belongsTo(customers::class, 'customers_id');
    }
}