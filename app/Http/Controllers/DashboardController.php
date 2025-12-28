<?php

namespace App\Http\Controllers;

use App\Models\customers;
use App\Models\Services;
use App\Models\ServiceOrder;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // 1. Statistik Dasar
            $totalPelanggan = customers::count();
            $totalLayanan = Services::count();
            
            // 2. Logika 2 Kata Kunci (Proses & Done)
            // Kita hitung 'proses' dan 'pending' jadi satu kelompok 'PROSES' agar sinkron
            $proses = ServiceOrder::whereIn('status', ['proses', 'pending'])->count();
            
            // Hitung yang sudah 'done' sebagai 'SELESAI'
            $done = ServiceOrder::where('status', 'done')->count();

            // Total pendapatan tetap dari yang sudah 'done'
            $totalPendapatan = ServiceOrder::where('status', 'done')->sum('total');

            return view('dashboard', compact(
                'totalPelanggan', 
                'totalLayanan', 
                'proses', 
                'done', 
                'totalPendapatan'
            ));

        } else {
            // Dashboard untuk Customer
            $myOrders = ServiceOrder::where('customers_id', $user->customer->id ?? 0)
                                    ->with('service')
                                    ->latest()
                                    ->get();

            return view('dashboard', compact('myOrders'));
        }
    }
}