<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Service;
use App\Models\ServiceOrder;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // 1. Statistik Dasar
            $totalPelanggan = Customer::count();
            $totalLayanan = Service::count();
            
            // 2. Logika 2 Kata Kunci (Proses & Done)
            // Hitung 'proses' dan 'pending' jadi satu kelompok 'PROSES'
            $proses = ServiceOrder::whereIn('status', ['proses', 'pending'])->count();
            
            // Hitung yang sudah 'done' sebagai 'SELESAI'
            $done = ServiceOrder::where('status', 'done')->count();

            // Total pendapatan tetap dari yang sudah 'done'
            $totalPendapatan = ServiceOrder::where('status', 'done')->sum('total_price');

            return view('dashboard', compact(
                'totalPelanggan', 
                'totalLayanan', 
                'proses', 
                'done', 
                'totalPendapatan'
            ));

        } else {
            // Dashboard untuk Customer
            // Ambil data profil customer milik user yang login
            $customer = $user->customer; 

            // Jika ada profilnya, ambil orderannya. Jika tidak, kirim koleksi kosong.
            $myOrders = $customer 
                ? ServiceOrder::where('customer_id', $customer->id)
                                ->with('service')
                                ->latest()
                                ->get()
                : collect();

            return view('dashboard', compact('myOrders'));
        }
    }
}