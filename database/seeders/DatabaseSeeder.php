<?php

namespace Database\Seeders;

use App\Models\customers;
use App\Models\services;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Kasir',
            'email' => 'kasir@example.com',
            'password' => Hash::make('password'),
            'role' => 'kasir',
        ]);

        services::insert([
            ['name' => 'Servis Ringan', 'price' => 100000, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Servis Besar',  'price' => 250000, 'created_at' => now(), 'updated_at' => now()],
        ]);

        customers::insert([
            ['name' => 'Budi', 'phone' => '08123456789', 'plate_number' => 'B 1234 CD', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Siti', 'phone' => '08129876543', 'plate_number' => 'F 9876 XY', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
