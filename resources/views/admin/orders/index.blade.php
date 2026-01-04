<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-800 tracking-tighter italic uppercase text-indigo-600">
            {{ Auth::user()->role == 'admin' ? 'Manajemen Order Servis' : 'Riwayat Servis Saya' }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        {{-- Alert Notifikasi --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-500 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl shadow-lg shadow-emerald-100 flex items-center">
                <i class="fas fa-check-circle mr-3 text-lg"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
            {{-- Header Tabel --}}
            <div class="px-8 py-8 border-b border-slate-50 bg-slate-50/30">
                <h3 class="font-black text-slate-800 uppercase tracking-tight italic text-sm">
                    {{ Auth::user()->role == 'admin' ? 'Semua Riwayat Antrean' : 'Daftar Servis Kendaraan Anda' }}
                </h3>
            </div>

            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/50 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-100">
                        <tr>
                            <th class="px-8 py-5 text-center w-16">#</th>
                            <th class="px-8 py-5">Tanggal</th>
                            @if(Auth::user()->role == 'admin')
                                <th class="px-8 py-5">Pelanggan</th>
                            @endif
                            <th class="px-8 py-5">Unit & Layanan</th>
                            <th class="px-8 py-5 text-center">Status</th>
                            <th class="px-8 py-5 text-right">Total</th>
                            @if(Auth::user()->role == 'admin')
                                <th class="px-8 py-5 text-center">Tindakan</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($orders as $order)
                        <tr class="hover:bg-slate-50/50 transition-all group">
                            <td class="px-8 py-6 text-center text-slate-300 text-[10px] font-black">{{ $loop->iteration }}</td>
                            <td class="px-8 py-6 text-xs font-bold text-slate-500 uppercase italic">
                                {{ \Carbon\Carbon::parse($order->service_date)->format('d M Y') }}
                            </td>
                            
                            @if(Auth::user()->role == 'admin')
                            <td class="px-8 py-6">
                                <span class="text-xs font-black text-slate-700 uppercase tracking-tight">
                                    {{ $order->customer->name ?? 'N/A' }}
                                </span>
                            </td>
                            @endif

                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-xs font-black text-indigo-600 uppercase italic tracking-tighter">{{ $order->plate_number }}</span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase italic">{{ $order->service->name ?? 'Servis Umum' }}</span>
                                </div>
                            </td>

                            <td class="px-8 py-6 text-center">
                                <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest
                                    {{ $order->status === 'selesai' ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-100' : '' }}
                                    {{ $order->status === 'proses' ? 'bg-blue-500 text-white shadow-lg shadow-blue-100' : '' }}
                                    {{ $order->status === 'pending' ? 'bg-amber-400 text-white shadow-lg shadow-amber-100' : '' }}">
                                    {{ $order->status }}
                                </span>
                            </td>

                            <td class="px-8 py-6 text-right font-black text-slate-700 text-sm italic">
                                Rp {{ number_format($order->total_price ?? $order->total, 0, ',', '.') }}
                            </td>

                            @if(Auth::user()->role == 'admin')
                            <td class="px-8 py-6 text-center">
                                <div class="flex justify-center items-center space-x-3">
                                    <a href="{{ route('orders.edit', $order->id) }}" class="p-2 bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white rounded-xl transition-all shadow-sm" title="Validasi">
                                        <i class="fas fa-check-circle"></i>
                                    </a>

                                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Hapus data order ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 bg-rose-50 text-rose-300 hover:bg-rose-500 hover:text-white rounded-xl transition-all shadow-sm">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-8 py-20 text-center">
                                <p class="text-slate-400 font-black italic uppercase text-xs tracking-widest">Belum ada antrean servis</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>