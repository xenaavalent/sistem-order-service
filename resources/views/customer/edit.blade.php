<x-app-layout>
    {{-- Header Judul --}}
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-black text-2xl text-slate-800 tracking-tighter italic uppercase text-indigo-600 ml-0">
                Ubah Data Pelanggan
            </h2>
        </div>
    </x-slot>

    {{-- Container agar ukuran card proporsional --}}
    <div class="max-w-4xl mt-4">
        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 ring-1 ring-slate-900/5 overflow-hidden">
            
            {{-- Header Form --}}
            <div class="px-10 py-8 border-b border-slate-50 bg-slate-50/30 flex justify-between items-center">
                <h3 class="font-black text-slate-800 uppercase tracking-tight italic">Edit Profil: {{ $customer->name }}</h3>
            </div>

            <div class="p-10">
                {{-- Pastikan route update menyertakan ID dan method PUT --}}
                <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-8">
                        {{-- Input Nama --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                                Nama Lengkap
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                value="{{ old('name', $customer->name) }}"
                                class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 font-medium text-slate-600 transition-all"
                                required
                            >
                            @error('name')
                                <p class="text-rose-500 text-[10px] font-bold mt-2 ml-2 uppercase italic tracking-wider">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Input No HP --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                                No. Telp
                            </label>
                            <input 
                                type="text" 
                                name="phone" 
                                value="{{ old('phone', $customer->phone) }}"
                                class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 font-medium text-slate-600 transition-all"
                            >
                            @error('phone')
                                <p class="text-rose-500 text-[10px] font-bold mt-2 ml-2 uppercase italic tracking-wider">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Input No Polisi --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                                Nomor Polisi (Plat Nomor)
                            </label>
                            <input 
                                type="text" 
                                name="plate_number" 
                                value="{{ old('plate_number', $customer->plate_number) }}"
                                class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 font-bold text-slate-700 transition-all uppercase"
                                required
                            >
                            @error('plate_number')
                                <p class="text-rose-500 text-[10px] font-bold mt-2 ml-2 uppercase italic tracking-wider">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tombol Navigasi & Aksi --}}
                        <div class="flex items-center justify-end space-x-4 pt-4">
                            <a href="{{ route('customers.index') }}" 
                               class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-slate-600 transition-all">
                                Kembali
                            </a>
                            
                            <button type="submit" 
                                    class="inline-flex items-center bg-amber-500 hover:bg-amber-600 text-white text-[10px] font-black py-4 px-10 rounded-2xl shadow-lg shadow-amber-600/20 transition-all uppercase tracking-widest group">
                                <i class="fas fa-sync-alt mr-2 group-hover:rotate-180 transition-transform duration-500"></i>
                                <span>Ubah Pelanggan</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>