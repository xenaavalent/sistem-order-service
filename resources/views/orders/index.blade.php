<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-black text-2xl text-slate-800 tracking-tighter italic uppercase text-indigo-600 ml-0">
                Order Servis
            </h2>
        </div>
    </x-slot>

    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden mt-4">
        <div class="px-8 py-8 border-b border-slate-50 bg-slate-50/30 flex justify-between items-center">
            <h3 class="font-black text-slate-800 uppercase tracking-tight italic">Riwayat Antrean & Transaksi</h3>
            <a href="{{ route('orders.create') }}" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-black py-3 px-6 rounded-2xl shadow-lg uppercase tracking-widest transition-all hover:scale-105">
                <i class="fas fa-plus mr-2"></i> Order Baru
            </a>
        </div>

        <div class="overflow-x-auto w-full">
            <table class="w-full text-left border-collapse min-w-[1100px]">
                <thead class="bg-slate-50/50 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-5 w-16 text-center">#</th>
                        <th class="px-6 py-5">Tanggal</th>
                        <th class="px-6 py-5">Pelanggan</th>
                        <th class="px-6 py-5 whitespace-nowrap">No. Polisi</th>
                        <th class="px-6 py-5">Layanan</th>
                        <th class="px-6 py-5">Status</th>
                        {{-- Header Total --}}
                        <th class="px-6 py-5 text-right">Total</th>
                        <th class="px-6 py-5 text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($orders as $order)
                    <tr class="hover:bg-slate-50/50 transition-all group">
                        <td class="px-6 py-6 text-sm text-slate-400 text-center">{{ $loop->iteration }}</td>
                        <td class="px-6 py-6 whitespace-nowrap text-xs font-bold text-slate-600 uppercase">
                            {{ \Carbon\Carbon::parse($order->service_date)->format('d M Y') }}
                        </td>
                        
                        <td class="px-6 py-6">
                            <span class="text-xs font-medium text-slate-600 tracking-tight block">
                                {{ $order->customer->name ?? '-' }}
                            </span>
                        </td>
                                                
                        <td class="px-6 py-6 whitespace-nowrap">
                             <span class="inline-flex px-3 py-1.5 rounded-lg text-[10px] font-semibold bg-slate-50 text-slate-600 border border-slate-200 uppercase tracking-tighter">
                                {{ $order->plate_number ?? '-' }}
                             </span>
                        </td>

                        <td class="px-6 py-6 text-xs font-bold text-indigo-600 uppercase">
                            {{ $order->service->name ?? '-' }}
                        </td>

                        <td class="px-6 py-6">
                            @if($order->status === 'done')
                                <span class="px-3 py-1 rounded-full text-[9px] font-black bg-emerald-100 text-emerald-600 border border-emerald-200 shadow-sm shadow-emerald-100">SELESAI</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-[9px] font-black bg-amber-100 text-amber-600 border border-amber-200 shadow-sm shadow-amber-100">PROSES</span>
                            @endif
                        </td>

                        {{-- BAGIAN YANG DIPERBAIKI: Mengambil harga langsung dari relasi layanan --}}
                        <td class="px-6 py-6 text-right font-black text-slate-800 text-sm whitespace-nowrap">
                            Rp {{ number_format($order->service->price ?? 0, 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-6">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('orders.edit', $order->id) }}" class="p-2 bg-amber-400 hover:bg-amber-500 text-white rounded-xl shadow-sm transition-colors">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Hapus order ini?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-rose-500 hover:bg-rose-600 text-white rounded-xl shadow-sm transition-colors">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-10 py-20 text-center text-slate-400 font-bold uppercase text-xs italic tracking-widest">
                            Belum ada order hari ini.
                        </td>
                    </tr>x
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>