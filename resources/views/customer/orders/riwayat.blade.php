<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-800 tracking-tighter uppercase italic text-indigo-600">
            Riwayat Servis
        </h2>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-4xl mx-auto"> {{-- Dipersempit sedikit agar lebih fokus --}}
            <div class="space-y-6">
                @forelse($orders as $order)
                    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col md:flex-row justify-between items-start md:items-center transition-all hover:shadow-lg hover:border-indigo-100 group">
                        
                        <div class="flex gap-6 items-center">
                            {{-- Icon Status Dinamis --}}
                            <div class="w-16 h-16 rounded-[1.5rem] flex items-center justify-center transition-transform group-hover:scale-110 duration-500
                                @if($order->status == 'selesai') bg-green-100 text-green-600 
                                @elseif($order->status == 'proses') bg-amber-100 text-amber-600
                                @elseif($order->status == 'batal') bg-rose-100 text-rose-600
                                @else bg-indigo-100 text-indigo-600 @endif">
                                <i class="fas 
                                    @if($order->status == 'selesai') fa-check-double 
                                    @elseif($order->status == 'proses') fa-sync fa-spin
                                    @elseif($order->status == 'batal') fa-times
                                    @else fa-calendar-check @endif text-2xl"></i>
                            </div>

                            <div>
                                {{-- Nama Motor --}}
                                <h3 class="font-black text-slate-800 uppercase italic tracking-tighter text-xl leading-none mb-1">
                                    {{ $order->vehicle->motor_type ?? $order->vehicle_name }}
                                </h3>
                                
                                {{-- Detail Layanan --}}
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest bg-slate-100 px-2 py-0.5 rounded-md">
                                        {{ $order->plate_number ?? ($order->vehicle->plate_number ?? 'N/A') }}
                                    </span>
                                    <span class="text-[10px] font-bold text-indigo-500 uppercase tracking-tight italic">
                                        {{ $order->services->pluck('name')->implode(', ') ?: 'Servis Umum' }}
                                    </span>
                                </div>

                                {{-- Tanggal --}}
                                <p class="text-[10px] text-slate-400 font-bold uppercase mt-2 flex items-center">
                                    <i class="far fa-clock mr-1.5 text-slate-300"></i>
                                    {{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d F Y, H:i') }}
                                </p>
                            </div>
                        </div>

                        <div class="text-left md:text-right mt-6 md:mt-0 w-full md:w-auto flex md:flex-col justify-between items-center md:items-end border-t md:border-t-0 pt-4 md:pt-0 border-slate-50">
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-0.5">Total Biaya</p>
                                <p class="font-black text-indigo-600 italic text-2xl tracking-tighter">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                            
                            {{-- Label Status yang Lebih Berwarna --}}
                            <span class="inline-block md:mt-3 px-5 py-1.5 rounded-full text-[9px] font-black uppercase tracking-[0.15em] shadow-sm
                                @if($order->status == 'selesai') bg-green-500 text-white
                                @elseif($order->status == 'proses') bg-amber-500 text-white
                                @elseif($order->status == 'batal') bg-rose-500 text-white
                                @else bg-slate-800 text-white @endif">
                                {{ $order->status ?? 'pending' }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-24 bg-white rounded-[3rem] border-2 border-dashed border-slate-100 px-6">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-history text-slate-200 text-4xl"></i>
                        </div>
                        <h4 class="text-slate-800 font-black italic uppercase text-lg tracking-tighter">Belum ada riwayat</h4>
                        <p class="text-slate-400 font-bold italic uppercase tracking-widest text-[10px] mt-1">Motor kamu butuh kasih sayang mekanik nih!</p>
                        <a href="{{ route('orders.create') }}" class="mt-8 inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] shadow-xl shadow-indigo-100 transition-all">
                            Booking Sekarang
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>