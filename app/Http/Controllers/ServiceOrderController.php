<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use App\Models\customers;
use App\Models\Services;
use Illuminate\Http\Request;

class ServiceOrderController extends Controller
{
    public function index()
    {
        $orders = ServiceOrder::with(['customer', 'service'])->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = customers::orderBy('name')->get();
        $services = Services::orderBy('name')->get();
        return view('orders.create', compact('customers', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id'  => 'required|exists:customers,id',
            'service_id'   => 'required|exists:services,id',
            'service_date' => 'required|date',
            'status'       => 'required|in:pending,done',
            'plate_number' => 'required|string|max:20',
        ]);

        $service = Services::findOrFail($request->service_id);

        ServiceOrder::create([
            'customers_id' => $request->customer_id, 
            'service_id'   => $request->service_id, 
            'service_date' => $request->service_date,
            'status'       => $request->status,
            'total'        => $service->price,
            'plate_number' => $request->plate_number,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order berhasil dibuat!');
    }

    public function edit(ServiceOrder $order)
    {
        $customers = customers::orderBy('name')->get();
        $services = Services::orderBy('name')->get();
        return view('orders.edit', compact('order', 'customers', 'services'));
    }

    public function update(Request $request, ServiceOrder $order)
    {
        $request->validate([
            'customer_id'  => 'required|exists:customers,id',
            'service_id'   => 'required|exists:services,id',
            'service_date' => 'required|date',
            'status'       => 'required|in:pending,done',
            'plate_number' => 'required|string|max:20',
        ]);

        $service = Services::findOrFail($request->service_id);

        $order->update([
            'customers_id' => $request->customer_id,
            'service_id'   => $request->service_id,
            'service_date' => $request->service_date,
            'status'       => $request->status,
            'total'        => $service->price,
            'plate_number' => $request->plate_number,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order diperbarui!');
    }

    public function destroy(ServiceOrder $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order dihapus.');
    }
}