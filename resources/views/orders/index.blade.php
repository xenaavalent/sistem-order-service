<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl tracking-tight text-slate-800">Order Servis</h2>
    </x-slot>

    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200/60 overflow-hidden mt-6">
        {{-- Header --}}
        <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
            <h3 class="font-semibold text-slate-700 text-sm">Riwayat Antrean</h3>
            <a href="{{ route('orders.create') }}" class="bg-indigo-600 text-white text-xs font-semibold py-2.5 px-5 rounded-xl shadow-md">
                + Order Baru
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/80 text-[11px] font-semibold text-slate-500 uppercase border-b">
                    <tr>
                        <th class="px-6 py-4 text-center">#</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Detail</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Total</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($orders as $order)
                    <tr class="hover:bg-slate-50/40 transition-colors">
                        <td class="px-6 py-6 text-center text-slate-400 text-xs">{{ $loop->iteration }}</td>
                        <td class="px-6 py-6 text-xs text-slate-600">{{ \Carbon\Carbon::parse($order->service_date)->format('d M Y') }}</td>
                        
                        {{-- MENAMPILKAN NAMA PELANGGAN --}}
                        <td class="px-6 py-6 font-semibold text-slate-800 text-sm capitalize">
                            {{ $order->customer->name ?? 'N/A' }}
                        </td>

                        <td class="px-6 py-5">
                            {{-- LOGIKA DETAIL KENDARAAN --}}
                            <span class="text-xs font-bold text-indigo-600">{{ $order->plate_number }}</span>
                        </td>

                        <td class="px-6 py-6 text-center">
                            <span class="px-3 py-1 rounded-lg text-[10px] font-semibold uppercase {{ $order->status === 'done' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
                                {{ $order->status }}
                            </span>
                        </td>

                        <td class="px-6 py-6 text-right font-semibold text-slate-700 text-sm">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-6 text-center">
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-slate-300 hover:text-rose-500"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>