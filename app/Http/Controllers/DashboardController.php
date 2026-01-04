<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Service;
use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. LOGIKA UNTUK ADMIN
        if ($user->role == 'admin') {
            $totalPelanggan = Customer::count();
            $totalLayanan = Service::count();

            // Sesuai revisi: Menggunakan DONE dan PROSES (Uppercase)
            $sedangProses = ServiceOrder::whereIn('status', ['PROSES', 'PENDING'])->count();
            $revenueSelesai = ServiceOrder::where('status', 'DONE')->sum('total_price');

            // Data untuk Grafik (Chart.js)
            $countSelesai = ServiceOrder::where('status', 'DONE')->count();
            $countProses = ServiceOrder::where('status', 'PROSES')->count();

            return view('dashboard', compact(
                'totalPelanggan', 
                'totalLayanan', 
                'sedangProses', 
                'revenueSelesai',
                'countSelesai',
                'countProses'
            ));
        } 
        
        // 2. LOGIKA UNTUK CUSTOMER
        else {
            // Ambil data customer dulu karena di service_orders yang disimpan adalah customer_id
            $customer = Customer::where('user_id', $user->id)->first();
            
            if (!$customer) {
                $myOrders = collect();
                $unitAktif = collect();
            } else {
                // Ambil Riwayat (Semua Order)
                $myOrders = ServiceOrder::where('customer_id', $customer->id) 
                    ->with('services') // Gunakan jamak 'services' sesuai Model Many-to-Many
                    ->latest()
                    ->get();

                // Ambil Unit Aktif (Hanya yang PENDING/PROSES)
                $unitAktif = ServiceOrder::where('customer_id', $customer->id)
                    ->whereIn('status', ['PENDING', 'PROSES'])
                    ->get();
            }

            return view('dashboard', compact('myOrders', 'unitAktif'));
        }
    }
}