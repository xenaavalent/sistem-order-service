<x-app-layout>
    {{-- Header Judul --}}
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-black text-2xl text-slate-800 tracking-tighter italic uppercase text-indigo-600 ml-0">
                Update Order Servis
            </h2>
        </div>
    </x-slot>

    {{-- Container Proporsional --}}
    <div class="max-w-4xl mt-4">
        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 ring-1 ring-slate-900/5 overflow-hidden">
            
            {{-- Header Card --}}
            <div class="px-10 py-8 border-b border-slate-50 bg-slate-50/30">
                <h3 class="font-black text-slate-800 uppercase tracking-tight italic">Edit Transaksi #{{ $order->id }}</h3>
            </div>

            <div class="p-10">
                <form action="{{ route('orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        {{-- Pilih Pelanggan --}}
                         <div class="space-y-2 md:col-span-2">
                            <label class="text-sm font-medium text-slate-600">Plat Nomor Kendaraan</label>
                            <input 
                                type="text" 
                                name="plate_number" 
                                value="{{ old('plate_number', $order->plate_number) }}"
                                class="w-full rounded-md border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                required
                            >
                        </div>

                        {{-- Pilih Layanan --}}
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                                Jenis Layanan Servis
                            </label>
                            <select name="service_id" class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 font-bold text-indigo-600 transition-all appearance-none cursor-pointer">
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ old('service_id', $order->service_id) == $service->id ? 'selected' : '' }}>
                                        {{ strtoupper($service->name) }} — Rp {{ number_format($service->price, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_id')
                                <p class="text-rose-500 text-[10px] font-bold mt-2 ml-2 uppercase italic">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tanggal Servis --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                                Tanggal Kedatangan
                            </label>
                            <input 
                                type="date" 
                                name="service_date" 
                                value="{{ old('service_date', $order->service_date) }}"
                                class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 font-medium text-slate-600 transition-all"
                            >
                            @error('service_date')
                                <p class="text-rose-500 text-[10px] font-bold mt-2 ml-2 uppercase italic">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                                Status Pengerjaan
                            </label>
                            @php $currentStatus = old('status', $order->status); @endphp
                            <select name="status" class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 font-bold text-slate-600 transition-all appearance-none cursor-pointer">
                                <option value="pending" {{ $currentStatus === 'pending' ? 'selected' : '' }}>🕒 PENDING (PROSES)</option>
                                <option value="done" {{ $currentStatus === 'done' ? 'selected' : '' }}>✅ DONE (SELESAI)</option>
                            </select>
                            @error('status')
                                <p class="text-rose-500 text-[10px] font-bold mt-2 ml-2 uppercase italic">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="md:col-span-2 flex items-center justify-end space-x-6 pt-6">
                            <a href="{{ route('orders.index') }}" 
                               class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-slate-600 transition-all">
                                Kembali
                            </a>
                            
                            <button type="submit" 
                                    class="inline-flex items-center bg-amber-500 hover:bg-amber-600 text-white text-[10px] font-black py-4 px-10 rounded-3xl shadow-lg shadow-amber-600/20 transition-all uppercase tracking-widest group">
                                <i class="fas fa-sync-alt mr-2 group-hover:rotate-180 transition-transform duration-700"></i>
                                <span>Perbarui Transaksi</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>