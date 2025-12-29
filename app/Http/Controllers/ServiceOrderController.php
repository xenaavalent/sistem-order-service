<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceOrder;
use App\Models\Customer;

class ServiceOrderController extends Controller
{
    public function index(Request $request)
{
    // Mengambil data order beserta data pelanggannya
    $query = ServiceOrder::with('customer'); 

    if ($request->search) {
        $query->where('plate_number', 'like', "%{$request->search}%");
    }

    $orders = $query->latest()->get();
    
    // Dibutuhkan untuk menampilkan nama layanan di kolom 'Detail'
    $allServices = Service::all()->keyBy('id');

    return view('orders.index', compact('orders', 'allServices'));
}

    public function create()
    {
        $services = Service::all();
        $allServices = $services->keyBy('id'); // Agar create.blade tidak error
        $customers = Customer::all();

        return view('orders.create', compact('services', 'allServices', 'customers'));
    }

    public function store(Request $request)
    {
        $total = 0;
        // Menghitung total harga layanan yang dipilih
        foreach ($request->service_id as $id) {
            $service = Service::find($id);
            if ($service) { $total += $service->price; }
        }

        ServiceOrder::create([
            'customer_id'  => $request->customer_id,
            'plate_number' => implode(', ', $request->plate_number),
            'service_id'   => implode(', ', $request->service_id),
            'total'        => $total,
            'status'       => 'pending',
            'service_date' => $request->service_date ?? now(),
        ]);

        return redirect()->route('orders.index')->with('success', 'Order berhasil!');
    }

    public function destroy(ServiceOrder $order)
    {
        $order->delete();
        return back();
    }
}