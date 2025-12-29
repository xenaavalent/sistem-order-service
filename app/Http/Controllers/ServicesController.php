<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServicesController extends Controller
{
    /**
     * Menampilkan daftar semua master layanan yang ada di database.
     */
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    /**
     * Menampilkan form untuk menambah jenis layanan baru.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Menyimpan master layanan baru (Nama Jasa & Harga).
     * Fokus fitur ini adalah input layanan yang nantinya dipilih customer.
     */
    public function store(Request $request)
    {
        // 1. Validasi input: Pastikan nama ada dan harga adalah angka
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        // 2. Simpan data ke tabel services
        // Pastikan model Service sudah memiliki properti $fillable = ['name', 'price']
        Service::create($validated);

        // 3. Kembali ke halaman create dengan pesan sukses
        return redirect()->route('services.create')->with('success', 'Master layanan berhasil ditambahkan ke sistem!');
    }

    /**
     * Opsional: Menghapus master layanan
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Layanan berhasil dihapus.');
    }
}