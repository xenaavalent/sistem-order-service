<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServicesController extends Controller
{
    /**
     * Tampilkan semua master jasa/layanan (Hanya Admin)
     */
    public function index()
    {
        $services = Service::orderBy('name', 'asc')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Form tambah layanan baru
     */
   public function create()
    {
        // Kita ambil semua data layanan agar tabel di sisi kanan create.blade tidak error
        $services = \App\Models\Service::orderBy('name', 'asc')->get();
        
        return view('admin.services.create', compact('services'));
    }
    /**
     * Simpan layanan baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255|unique:services,name',
            'price' => 'required|numeric|min:0',
        ]);

        Service::create([
            'name'  => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('services.index')->with('success', 'Layanan berhasil ditambahkan!');
    }

    /**
     * Form edit layanan
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update data layanan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255|unique:services,name,' . $id,
            'price' => 'required|numeric|min:0',
        ]);

        $service = Service::findOrFail($id);
        $service->update([
            'name'  => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('services.index')->with('success', 'Layanan berhasil diperbarui!');
    }

    /**
     * Hapus layanan
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        
        // Cek jika layanan masih terikat dengan order (opsional, tergantung kebutuhan bisnis)
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Layanan berhasil dihapus!');
    }
}