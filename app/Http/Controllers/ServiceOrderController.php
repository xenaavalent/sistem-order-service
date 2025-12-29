<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceOrder;
use App\Models\services; 
use App\Models\customers;

class ServiceOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceOrder::with('customer');

        // Filter Pencarian
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('plate_number', 'like', "%{$search}%")
                  ->orWhereHas('customer', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        $orders = $query->latest()->get();
        $allServices = services::all()->keyBy('id');
        
        return view('orders.index', compact('orders', 'allServices'));
    }

    public function create()
    {
        $customers = customers::all();
        $allServices = services::all();
        return view('orders.create', compact('customers', 'allServices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customers_id' => 'required',
            'plate_numbers' => 'required|array',
            'service_ids' => 'required|array',
        ]);

        $totalHarga = services::whereIn('id', $request->service_ids)->sum('price');

        ServiceOrder::create([
            'customers_id' => $request->customers_id,
            'plate_number' => implode(', ', array_map('strtoupper', $request->plate_numbers)),
            'service_id'   => implode(', ', $request->service_ids),
            'service_date' => now(), 
            'status'       => 'proses',
            'total'        => $totalHarga,
        ]);

        return redirect()->route('orders.index');
    }

    public function edit($id)
    {
        $order = ServiceOrder::findOrFail($id);
        $customers = customers::all();
        $allServices = services::all();
        return view('orders.edit', compact('order', 'customers', 'allServices'));
    }

    public function update(Request $request, $id)
    {
        $order = ServiceOrder::findOrFail($id);
        
        $totalHarga = services::whereIn('id', $request->service_ids)->sum('price');

        $order->update([
            'customers_id' => $request->customers_id,
            'plate_number' => implode(', ', array_map('strtoupper', $request->plate_numbers)),
            'service_id'   => implode(', ', $request->service_ids),
            'status'       => $request->status,
            'total'        => $totalHarga,
        ]);

        return redirect()->route('orders.index');
    }

    public function destroy($id)
    {
        ServiceOrder::findOrFail($id)->delete();
        return redirect()->route('orders.index');
    }
}