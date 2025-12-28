<?php

namespace App\Http\Controllers;

use App\Models\customers;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{
    /**
     * Menampilkan daftar semua pelanggan
     */
    public function index()
    {
        // Mengambil data customer urut abjad nama
        $customers = customers::orderBy('name')->get();
        return view('customer.index', compact('customers'));
    }

    /**
     * Menampilkan form tambah pelanggan baru
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Menyimpan data pelanggan baru dan akun loginnya
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email', 
            'password'     => 'required|string|min:6',
            'phone'        => 'nullable|string|max:30',
            'plate_number' => 'nullable|string|max:20',
        ]);

        // Gunakan Database Transaction agar jika salah satu gagal, semua dibatalkan
        DB::beginTransaction();

        try {
            // 2. Buat akun di tabel USERS
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'customer', // Memastikan role terisi
            ]);

            // 3. Buat data di tabel CUSTOMERS dan hubungkan dengan user_id
            customers::create([
                'user_id'      => $user->id,
                'name'         => $request->name,
                'phone'        => $request->phone,
                'plate_number' => $request->plate_number,
            ]);

            DB::commit();
            return redirect()->route('customers.index')->with('success', 'Pelanggan dan Akun Login berhasil dibuat.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan form edit pelanggan
     */
    public function edit(customers $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    /**
     * Memperbarui data profil pelanggan (tidak mengubah password/email user)
     */
    public function update(Request $request, customers $customer)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'phone'        => 'nullable|string|max:30',
            'plate_number' => 'nullable|string|max:20',
        ]);

        $customer->update($data);

        return redirect()->route('customers.index')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    /**
     * Menghapus pelanggan beserta akun loginnya
     */
    public function destroy(customers $customer)
    {
        DB::beginTransaction();

        try {
            // Cari User terkait melalui relasi (pastikan relasi user() sudah ada di model customers)
            if ($customer->user) {
                $customer->user()->delete(); 
            }
            
            // Hapus data customer
            $customer->delete();

            DB::commit();
            return redirect()->route('customers.index')->with('success', 'Pelanggan dan Akun Login berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus data.');
        }
    }
}