<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl tracking-tight text-slate-800">Order Servis</h2>
    </x-slot>

    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200/60 overflow-hidden mt-6 transition-all duration-500">
        {{-- Header & Search --}}
        <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50 flex flex-col md:flex-row justify-between items-center gap-4">
            <h3 class="font-semibold text-slate-700 text-sm tracking-tight">Riwayat Antrean</h3>
            
            <div class="flex items-center gap-3">
                <form action="{{ route('orders.index') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..." 
                           class="bg-white border-slate-200 rounded-xl text-xs py-2 px-10 focus:ring-indigo-500">
                    <i class="fas fa-search absolute left-4 top-3 text-slate-400 text-xs"></i>
                </form>
                <a href="{{ route('orders.create') }}" class="bg-indigo-600 text-white text-xs font-semibold py-2.5 px-5 rounded-xl shadow-md hover:bg-indigo-700 hover:scale-[1.02] transition-all">
                    + Order Baru
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[1000px]">
                <thead class="bg-slate-50/80 text-[11px] font-semibold text-slate-500 uppercase tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-center w-16">#</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Detail Kendaraan & Layanan</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Total</th>
                        <th class="px-6 py-4 text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($orders as $order)
                    <tr class="hover:bg-slate-50/40 transition-colors align-top">
                        <td class="px-6 py-6 text-center text-slate-400 text-xs">{{ $loop->iteration }}</td>
                        <td class="px-6 py-6 text-xs text-slate-600 font-medium">{{ \Carbon\Carbon::parse($order->service_date)->format('d M Y') }}</td>
                        <td class="px-6 py-6 font-semibold text-slate-800 text-sm capitalize">{{ strtolower($order->customer->name ?? 'N/A') }}</td>

                        <td class="px-6 py-5">
                            <div class="flex flex-col gap-2">
                                @php 
                                    $plates = explode(', ', $order->plate_number);
                                    $services = explode(', ', $order->service_id);
                                @endphp
                                @foreach($plates as $index => $plate)
                                <div class="flex items-center gap-3 py-1 px-3 bg-slate-50 rounded-lg border border-slate-100/80">
                                    <span class="text-[11px] font-bold text-indigo-600 min-w-[100px]">{{ $plate }}</span>
                                    <div class="h-4 w-px bg-slate-200"></div>
                                    <span class="text-[11px] text-slate-500 font-medium uppercase">{{ $allServices[$services[$index]]->name ?? 'Layanan' }}</span>
                                </div>
                                @endforeach
                            </div>
                        </td>

                        <td class="px-6 py-6 text-center">
                            <span class="px-3 py-1 rounded-lg text-[10px] font-semibold uppercase {{ $order->status === 'done' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
                                {{ $order->status }}
                            </span>
                        </td>

                        <td class="px-6 py-6 text-right font-semibold text-slate-700 text-sm">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-6">
                            <div class="flex items-center justify-center gap-4">
                                <a href="{{ route('orders.edit', $order->id) }}" class="text-slate-300 hover:text-indigo-600 transition-colors">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Hapus order?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-slate-300 hover:text-rose-500 transition-colors">
                                        <i class="fas fa-trash-alt text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>