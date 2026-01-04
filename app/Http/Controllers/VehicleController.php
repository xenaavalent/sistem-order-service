<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Menampilkan daftar kendaraan.
     */
    public function index()
    {
        $user = auth()->user();
        
        if ($user->role == 'admin') {
            // Admin melihat semua motor + info akun user-nya
            $vehicles = Vehicle::with('user')->latest()->get();
        } else {
            // Customer melihat motor berdasarkan user_id mereka sendiri
            $vehicles = Vehicle::where('user_id', $user->id)->latest()->get();
        }

        return view('customer.vehicles.index', compact('vehicles'));
    }

    /**
     * Form tambah kendaraan.
     */
    public function create()
    {
        return view('customer.vehicles.create');
    }

    /**
     * Simpan kendaraan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'plate_number' => 'required|string|unique:vehicles,plate_number',
            'motor_type'   => 'required|string',
        ]);

        // Pakai user_id sesuai kolom di DB kamu
        Vehicle::create([
            'user_id'      => auth()->id(), 
            'plate_number' => strtoupper($request->plate_number),
            'motor_type'   => $request->motor_type,
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Motor berhasil ditambah ke garasi!');
    }

    /**
     * Form Edit.
     */
    public function edit(Vehicle $vehicle)
    {
        // Proteksi: Pastikan yang edit adalah pemiliknya atau admin
        if (auth()->user()->role !== 'admin' && $vehicle->user_id !== auth()->id()) {
            abort(403, 'Akses ilegal.');
        }

        return view('customer.vehicles.edit', compact('vehicle'));
    }

    /**
     * Update data kendaraan.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        if (auth()->user()->role !== 'admin' && $vehicle->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'plate_number' => 'required|string|unique:vehicles,plate_number,' . $vehicle->id,
            'motor_type'   => 'required|string|max:255',
        ]);

        $vehicle->update([
            'plate_number' => strtoupper($request->plate_number),
            'motor_type'   => $request->motor_type,
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Data motor berhasil diperbarui!');
    }

    /**
     * Hapus kendaraan.
     */
    public function destroy(Vehicle $vehicle)
    {
        if (auth()->user()->role !== 'admin' && $vehicle->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $vehicle->delete();
        return back()->with('success', 'Motor berhasil dihapus.');
    }
}