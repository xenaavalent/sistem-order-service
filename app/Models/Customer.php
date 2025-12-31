<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'name', 
        'email',
        'phone', 
        'vehicle_brand', 
        'vehicle_type', 
        'plate_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function serviceOrders()
    {
        return $this->hasMany(ServiceOrder::class, 'customer_id');
    }
}