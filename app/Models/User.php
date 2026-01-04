<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Role: admin atau customer
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke model Customer
     * Menghubungkan akun login dengan data profil pelanggan
     */
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    /**
     * Relasi ke model Vehicle (REVISI: Ditambahkan)
     * Karena tabel vehicles pakai user_id, Xena bisa panggil $user->vehicles
     */
    public function vehicles()
    {
        // Satu User (Customer) bisa mendaftarkan banyak kendaraan
        return $this->hasMany(Vehicle::class);
    }
}