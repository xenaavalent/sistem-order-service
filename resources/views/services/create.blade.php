<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-black text-2xl text-slate-800 tracking-tighter italic uppercase text-indigo-600">
                Tambah Layanan Baru
            </h2>
        </div>
    </x-slot>

    {{-- Container dibuat max-width agar tidak terlalu lebar/gede --}}
    <div class="max-w-4xl mt-4">
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 ring-1 ring-slate-900/5 overflow-hidden">
            
            <div class="px-10 py-8 border-b border-slate-50 bg-slate-50/30">
                <h3 class="font-black text-slate-800 uppercase tracking-tight italic">Formulir Layanan</h3>
            </div>

            <div class="p-10">
                <form action="{{ route('services.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 gap-8">
                        {{-- Input Nama Layanan --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                                Nama Layanan
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                value="{{ old('name') }}"
                                class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 font-medium text-slate-600 placeholder-slate-300 transition-all"
                                placeholder="Contoh: Ganti Oli Mesin"
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
                                value="{{ old('price') }}"
                                class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 font-medium text-slate-600 placeholder-slate-300 transition-all"
                                placeholder="Masukkan nominal harga"
                                required
                            >
                            @error('price')
                                <p class="text-rose-500 text-[10px] font-bold mt-2 ml-2 uppercase italic tracking-wider">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex items-center justify-end space-x-4 pt-4">
                            <a href="{{ route('services.index') }}" 
                               class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-slate-600 transition-all">
                                Batal
                            </a>
                            
                            <button type="submit" 
                                    class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-black py-4 px-8 rounded-2xl shadow-lg shadow-indigo-600/20 transition-all uppercase tracking-widest">
                                <i class="fas fa-save mr-2"></i>
                                <span>Simpan Layanan</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>