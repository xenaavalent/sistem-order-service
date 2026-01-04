<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{
    /**
     * Menampilkan daftar semua pelanggan (Wilayah Admin)
     */
    public function index()
    {
        $customers = Customer::orderBy('name')->get();
        return view('admin.customer.index', compact('customers'));
    }

    /**
     * Menampilkan form tambah pelanggan baru (Wilayah Admin)
     */
    public function create()
    {
        return view('admin.customer.create');
    }

    /**
     * Menyimpan data pelanggan baru dan akun loginnya
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email', 
            'password' => 'required|string|min:6',
            'phone'    => 'nullable|string|max:30',
            // plate_number SUDAH DIHAPUS DARI SINI
        ]);

        DB::beginTransaction();

        try {
            // 1. Buat akun di tabel USERS
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'customer', 
            ]);

            // 2. Buat data di tabel CUSTOMERS
            Customer::create([
                'user_id' => $user->id,
                'name'    => $request->name,
                'email'   => $request->email,
                'phone'   => $request->phone,
                // plate_number SUDAH DIHAPUS DARI SINI
            ]);

            DB::commit();
            return redirect()->route('customers.index')->with('success', 'Pelanggan berhasil didaftarkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mendaftar: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan form edit pelanggan (Wilayah Admin)
     */
    public function edit(Customer $customer)
    {
        return view('admin.customer.edit', compact('customer'));
    }

    /**
     * Memperbarui data profil, email, dan password
     */
    public function update(Request $request, Customer $customer)
    {
        $user = User::find($customer->user_id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . ($user->id ?? 0),
            'phone'    => 'nullable|string|max:30',
            'password' => 'nullable|string|min:6', 
            // plate_number SUDAH DIHAPUS DARI SINI
        ]);

        DB::beginTransaction();

        try {
            $customer->update([
                'name'  => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                // plate_number SUDAH DIHAPUS DARI SINI
            ]);

            if ($user) {
                $userData = [
                    'name'  => $request->name,
                    'email' => $request->email,
                ];

                if ($request->filled('password')) {
                    $userData['password'] = Hash::make($request->password);
                }

                $user->update($userData);
            }

            DB::commit();
            return redirect()->route('customers.index')->with('success', 'Data pelanggan berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus pelanggan beserta akun loginnya
     */
    public function destroy(Customer $customer)
    {
        DB::beginTransaction();

        try {
            if ($customer->user_id) {
                User::where('id', $customer->user_id)->delete();
            }
            
            $customer->delete();

            DB::commit();
            return redirect()->route('customers.index')->with('success', 'Data berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus data.');
        }
    }
}