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
            // Kita hitung 'proses' dan 'pending' jadi satu kelompok 'PROSES' agar sinkron
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
            $myOrders = ServiceOrder::where('customer_id', $user->customer->id ?? 0)
                                    ->with('service')
                                    ->latest()
                                    ->get();

            return view('dashboard', compact('myOrders'));
        }
    }
}