<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ServiceOrder extends Model
{
    protected $table = 'service_orders'; 

    protected $fillable = [
        'customer_id',
        'vehicle_id',    
        'vehicle_name', // TAMBAHKAN INI: Agar nama motor tersimpan di riwayat
        'plate_number', 
        'total_price',   
        'status',
        'service_date',
        'notes',
    ];

    /**
     * RELASI: Banyak Layanan (Many-to-Many)
     * Menghubungkan Order dengan tabel Services melalui tabel perantara order_service.
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'order_service')
                    ->withPivot('price') // Mengambil harga snapshot saat booking
                    ->withTimestamps();
    }

    /**
     * Relasi ke Pelanggan
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Relasi ke Kendaraan
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}