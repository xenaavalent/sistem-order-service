<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl tracking-tighter italic uppercase text-indigo-600">
            Validasi & Update Status Order
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-12 px-4 pb-20">
        <div class="bg-white p-10 rounded-[3.5rem] shadow-sm border border-slate-100 ring-1 ring-slate-900/5">
            
            {{-- Informasi Ringkas Order --}}
            <div class="mb-8 p-8 bg-slate-50 rounded-[2.5rem] border border-dashed border-slate-200">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Unit Kendaraan</p>
                        <h4 class="font-black text-slate-800 uppercase italic text-2xl tracking-tighter leading-none">
                            {{ $order->plate_number }} 
                        </h4>
                        <p class="text-xs font-bold text-slate-500 uppercase italic mt-1">{{ $order->vehicle_name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Pelanggan</p>
                        <p class="font-bold text-indigo-600 uppercase text-xs italic">{{ $order->customer->user->name ?? 'Guest' }}</p>
                    </div>
                </div>

                {{-- Daftar Layanan yang dipilih --}}
                <div class="mt-6 pt-6 border-t border-slate-200">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 italic">Layanan yang diminta:</p>
                    <div class="space-y-2">
                        @foreach($order->services as $service)
                            <div class="flex justify-between items-center bg-white/50 p-3 rounded-xl border border-slate-100">
                                <span class="text-[11px] font-black text-slate-700 uppercase italic tracking-tight">
                                    <i class="fas fa-check-circle text-indigo-500 mr-2"></i> {{ $service->name }}
                                </span>
                                {{-- Mengambil harga dari tabel pivot --}}
                                <span class="text-[11px] font-bold text-slate-500">Rp {{ number_format($service->pivot->price, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-4 flex justify-between items-center px-2">
                        <p class="text-[10px] font-black text-slate-800 uppercase italic">Total Biaya</p>
                        <p class="font-black text-indigo-600 italic">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>

                {{-- Catatan Customer --}}
                @if($order->notes)
                <div class="mt-4 p-4 bg-amber-50 rounded-2xl border border-amber-100">
                    <p class="text-[9px] font-black text-amber-600 uppercase tracking-widest mb-1 italic">Catatan Keluhan:</p>
                    <p class="text-[11px] text-amber-800 italic">"{{ $order->notes }}"</p>
                </div>
                @endif
            </div>

            {{-- Form Update Status --}}
            <form action="{{ route('orders.update', $order->id) }}" method="POST" class="space-y-8">
                @csrf 
                @method('PUT')
                
                <div class="space-y-4">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2 italic">Update Status Pengerjaan</label>
                    
                    <div class="relative">
                        {{-- REVISI VALUE: Sesuaikan dengan ENUM/Uppercase di Database --}}
                        <select name="status" class="w-full rounded-[1.5rem] border-slate-100 bg-slate-50 py-4 px-6 font-black text-slate-700 italic uppercase tracking-tighter focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all appearance-none cursor-pointer">
                            <option value="PENDING" {{ $order->status == 'PENDING' ? 'selected' : '' }}>🕒 PENDING (Menunggu)</option>
                            <option value="PROSES" {{ $order->status == 'PROSES' ? 'selected' : '' }}>🔧 PROSES (Sedang Dikerjakan)</option>
                            <option value="DONE" {{ $order->status == 'DONE' ? 'selected' : '' }}>✅ SELESAI (Siap Diambil)</option>
                            <option value="BATAL" {{ $order->status == 'BATAL' ? 'selected' : '' }}>❌ BATAL (Cancel)</option>
                        </select>
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <i class="fas fa-chevron-down text-xs"></i>
                        </div>
                    </div>
                    
                    <p class="text-[9px] text-slate-400 ml-4">*Mengubah status akan langsung memperbarui riwayat di sisi Pelanggan secara real-time.</p>
                </div>

                <div class="flex gap-4 pt-4">
                    <a href="{{ route('orders.index') }}" class="flex-1 text-center bg-slate-100 hover:bg-slate-200 text-slate-500 text-[10px] font-black py-5 rounded-[2rem] uppercase tracking-widest transition-all leading-relaxed flex items-center justify-center">
                        Batal
                    </a>
                    <button type="submit" class="flex-[2] bg-slate-900 hover:bg-indigo-600 text-white text-[10px] font-black py-5 rounded-[2rem] shadow-xl shadow-slate-100 uppercase tracking-widest transition-all flex items-center justify-center group">
                        Simpan Perubahan
                        <i class="fas fa-save ml-3 group-hover:scale-125 transition-transform"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>