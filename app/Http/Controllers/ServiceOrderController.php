<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceOrder;
use App\Models\Vehicle;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ServiceOrderController extends Controller
{
    /**
     * Menampilkan daftar order (Admin) atau Riwayat (Customer)
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $orders = ServiceOrder::with(['services', 'customer.user', 'vehicle'])->latest()->get();
            return view('admin.orders.index', compact('orders'));
        }

        $customer = Customer::where('user_id', $user->id)->first();
        $orders = $customer 
            ? ServiceOrder::where('customer_id', $customer->id)->with(['services', 'vehicle'])->latest()->get()
            : collect();
                    
        return view('customer.orders.riwayat', compact('orders'));
    }

    /**
     * Form Booking untuk Customer
     */
    public function create()
    {
        $allServices = Service::orderBy('name', 'asc')->get();
        $myVehicles = Vehicle::where('user_id', Auth::id())->get();

        if ($myVehicles->isEmpty()) {
            return redirect()->route('vehicles.create')
                ->with('error', 'Silakan tambah kendaraan di garasi dulu sebelum booking!');
        }

        return view('customer.orders.create', compact('allServices', 'myVehicles'));
    }

    /**
     * Menyimpan data booking baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'service_ids' => 'required|array|min:1',
            'total_price' => 'required|numeric',
        ]);

        $vehicle = Vehicle::findOrFail($request->vehicle_id);
        $customer = Customer::where('user_id', Auth::id())->first();

        if (!$customer) {
            return back()->with('error', 'Profil customer tidak ditemukan.');
        }

        DB::transaction(function () use ($request, $customer, $vehicle) {
            $order = ServiceOrder::create([
                'customer_id'  => $customer->id,
                'vehicle_id'   => $vehicle->id, 
                'vehicle_name' => $vehicle->motor_type,
                'plate_number' => $vehicle->plate_number,
                'total_price'  => $request->total_price, 
                'status'       => 'PENDING',
                'service_date' => now(),
                'notes'        => $request->notes,
            ]);

            foreach ($request->service_ids as $id) {
                $service = Service::find($id);
                $order->services()->attach($id, ['price' => $service->price]);
            }
        });

        return redirect()->route('riwayat.index')->with('success', 'Booking berhasil!');
    }

    /**
     * HALAMAN EDIT: Untuk Admin mengubah status order
     */
    public function edit($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $order = ServiceOrder::with(['services', 'customer.user', 'vehicle'])->findOrFail($id);
        $statuses = ['PENDING', 'PROSES', 'DONE', 'BATAL'];

        return view('admin.orders.edit', compact('order', 'statuses'));
    }

    /**
     * PROSES UPDATE: Menyimpan perubahan status
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:PENDING,PROSES,DONE,BATAL',
        ]);

        $order = ServiceOrder::findOrFail($id);
        $order->update([
            'status' => $request->status,
            'notes'  => $request->notes,
        ]);

        // Jika admin, balikkan ke daftar order admin, jika customer (jika ada fitur edit) ke riwayat
        $route = Auth::user()->role === 'admin' ? 'orders.index' : 'riwayat.index';

        return redirect()->route($route)->with('success', 'Data order berhasil diperbarui!');
    }

    /**
     * Hapus Order
     */
    public function destroy($id)
    {
        $order = ServiceOrder::findOrFail($id);
        $order->delete();

        return back()->with('success', 'Data order berhasil dihapus.');
    }
}