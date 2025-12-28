<?php

namespace App\Http\Controllers;

use App\Models\services; // Pastikan nama model di folder Models memang 'services' (huruf kecil & jamak)
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $services = services::all(); 
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|integer|min:0',
        ]);

        services::create($data);

        return redirect()
            ->route('services.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    /**
     * REVISI DI SINI:
     * Nama parameter diubah jadi $service (tunggal) agar sinkron dengan compact
     */
    public function edit(services $service) 
    {
        // Parameter di atas adalah $service, maka compact-nya harus 'service'
        return view('services.edit', compact('service'));
    }

    /**
     * REVISI DI SINI:
     * Nama parameter disamakan jadi $service (tunggal) agar konsisten
     */
    public function update(Request $request, Services $service)
{
    // 1. Update data layanan itu sendiri
    $service->update($request->all());

    // 2. LOGIKA TAMBAHAN: Update harga di order yang masih PENDING
    // Agar harga di riwayat ikut terbaru
    \App\Models\ServiceOrder::where('service_id', $service->id)
        ->where('status', 'pending')
        ->update(['total' => $service->price]);

    return redirect()->route('services.index')->with('success', 'Harga layanan diperbarui!');
}

    /**
     * REVISI DI SINI:
     * Nama parameter disamakan jadi $service
     */
    public function destroy(services $service)
    {
        $service->delete();

        return redirect()
            ->route('services.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}