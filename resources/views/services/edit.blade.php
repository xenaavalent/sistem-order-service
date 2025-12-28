<x-app-layout>
    {{-- Header Judul --}}
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-black text-2xl text-slate-800 tracking-tighter italic uppercase text-indigo-600 ml-0">
                Edit Layanan Servis
            </h2>
        </div>
    </x-slot>

    {{-- Container max-w-4xl agar ukuran card proporsional/tidak kegedean --}}
    <div class="max-w-4xl mt-4">
        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 ring-1 ring-slate-900/5 overflow-hidden">
            
            {{-- Header Form --}}
            <div class="px-10 py-8 border-b border-slate-50 bg-slate-50/30 flex justify-between items-center">
                <h3 class="font-black text-slate-800 uppercase tracking-tight italic">Ubah Data Layanan</h3>
            </div>

            <div class="p-10">
                {{-- Form Action menggunakan variabel $service hasil revisi Controller --}}
                <form action="{{ route('services.update', $service->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-8">
                        {{-- Input Nama Layanan --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                                Nama Layanan
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                value="{{ old('name', $service->name) }}"
                                class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 font-medium text-slate-600 transition-all"
                                required
                            >
                            @error('name')
                                <p class="text-rose-500 text-[10px] font-bold mt-2 ml-2 uppercase italic tracking-wider">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Input Harga --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                                Harga Resmi (Rp)
                            </label>
                            <input 
                                type="number" 
                                name="price" 
                                value="{{ old('price', $service->price) }}"
                                class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 font-medium text-slate-600 transition-all"
                                required
                            >
                            @error('price')
                                <p class="text-rose-500 text-[10px] font-bold mt-2 ml-2 uppercase italic tracking-wider">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tombol Navigasi & Aksi --}}
                        <div class="flex items-center justify-end space-x-4 pt-4">
                            <a href="{{ route('services.index') }}" 
                               class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-slate-600 transition-all">
                                Kembali
                            </a>
                            
                            <button type="submit" 
                                    class="inline-flex items-center bg-amber-500 hover:bg-amber-600 text-white text-[10px] font-black py-4 px-10 rounded-2xl shadow-lg shadow-amber-600/20 transition-all uppercase tracking-widest">
                                <i class="fas fa-sync-alt mr-2"></i>
                                <span>Ubah Layanan</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>