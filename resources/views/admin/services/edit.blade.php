<x-app-layout>
    {{-- Header Judul --}}
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-black text-2xl text-slate-800 tracking-tighter italic uppercase text-indigo-600 ml-0">
                Edit Layanan Servis
            </h2>
        </div>
    </x-slot>

    {{-- Container terpusat agar fokus --}}
    <div class="max-w-3xl mt-12 mx-auto">
        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden">
            
            {{-- Header Form dengan Icon Edit --}}
            <div class="px-10 py-8 border-b border-slate-50 bg-slate-50/30 flex justify-between items-center">
                <div>
                    <h3 class="font-black text-slate-800 uppercase tracking-tight italic">Ubah Data Layanan</h3>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">ID Layanan: #{{ $service->id }}</p>
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-2xl flex items-center justify-center text-amber-600">
                    <i class="fas fa-edit text-lg"></i>
                </div>
            </div>

            <div class="p-10">
                <form action="{{ route('services.update', $service->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-8">
                        {{-- Input Nama Layanan --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.2em] ml-2 block">
                                Nama Layanan
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                value="{{ old('name', $service->name) }}"
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-amber-500 font-bold text-slate-700 transition-all placeholder:text-slate-300"
                                required
                                placeholder="Misal: Service Besar"
                            >
                            @error('name')
                                <p class="text-rose-500 text-[10px] font-black mt-2 ml-2 uppercase italic tracking-wider animate-pulse">
                                    <i class="fas fa-exclamation-triangle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Input Harga --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.2em] ml-2 block">
                                Harga Jual (Rp)
                            </label>
                            <input 
                                type="number" 
                                name="price" 
                                value="{{ old('price', $service->price) }}"
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-amber-500 font-bold text-slate-700 transition-all"
                                required
                            >
                            @error('price')
                                <p class="text-rose-500 text-[10px] font-black mt-2 ml-2 uppercase italic tracking-wider animate-pulse">
                                    <i class="fas fa-exclamation-triangle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Tombol Aksi Bersandingan --}}
                        <div class="grid grid-cols-2 gap-4 pt-6">
                            {{-- Tombol Kembali --}}
                            <a href="{{ route('services.index') }}" 
                               class="flex items-center justify-center bg-slate-100 hover:bg-slate-200 text-slate-500 text-[10px] font-black py-4 rounded-2xl transition-all uppercase tracking-widest gap-2">
                                <i class="fas fa-arrow-left"></i>
                                <span>Batal</span>
                            </a>
                            
                            {{-- Tombol Update --}}
                            <button type="submit" 
                                    class="flex items-center justify-center bg-amber-500 hover:bg-amber-600 text-white text-[10px] font-black py-4 rounded-2xl shadow-lg shadow-amber-200 transition-all uppercase tracking-widest gap-2">
                                <i class="fas fa-save"></i>
                                <span>Simpan Perubahan</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Footer Note --}}
        <p class="text-center mt-8 text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em]">
            Pastikan harga sudah sesuai dengan standar bengkel
        </p>
    </div>
</x-app-layout>