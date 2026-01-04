<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-800 tracking-tighter italic uppercase text-indigo-600">
            Manajemen Master Layanan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Sisi Kiri: Form Input --}}
                <div class="lg:col-span-1">
                    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 sticky top-24">
                        <div class="mb-6">
                            <h3 class="font-black text-slate-800 uppercase italic tracking-tighter text-lg">Input Jasa Baru</h3>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Master Data Bengkel</p>
                        </div>

                        <form action="{{ route('services.store') }}" method="POST">
                            @csrf
                            <div class="space-y-5">
                                {{-- Input Nama --}}
                                <div>
                                    <label class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.2em] ml-2 mb-2 block">Nama Layanan</label>
                                    <input type="text" name="name" value="{{ old('name') }}" required
                                        class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl @error('name') ring-2 ring-red-500 @enderror focus:ring-2 focus:ring-indigo-500 font-bold text-slate-700 placeholder:text-slate-300 transition-all"
                                        placeholder="Misal: Ganti Oli MPX 1">
                                    
                                    @error('name')
                                        <p class="text-[10px] text-red-500 font-bold mt-2 ml-2 uppercase italic">
                                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- Input Harga --}}
                                <div>
                                    <label class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.2em] ml-2 mb-2 block">Harga Jual (Rp)</label>
                                    <input type="number" name="price" value="{{ old('price') }}" required
                                        class="w-full px-5 py-3.5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-slate-700 placeholder:text-slate-300 transition-all"
                                        placeholder="50000">
                                </div>

                                {{-- Group Tombol Action --}}
                                <div class="flex flex-col gap-3 pt-4">
                                    <button type="submit" 
                                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-black py-4 rounded-2xl shadow-lg shadow-indigo-100 transition-all uppercase italic tracking-widest text-xs flex items-center justify-center gap-2">
                                        <i class="fas fa-plus-circle"></i> Simpan Layanan
                                    </button>

                                    <a href="{{ route('services.index') }}" 
                                        class="w-full bg-slate-100 hover:bg-slate-200 text-slate-500 font-black py-4 rounded-2xl transition-all uppercase italic tracking-widest text-[10px] flex items-center justify-center gap-2">
                                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Sisi Kanan: Tabel Daftar Harga --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                        <div class="p-8 border-b border-slate-50 bg-slate-50/50 flex justify-between items-center">
                            <div>
                                <h3 class="font-black text-slate-800 uppercase italic tracking-tighter text-lg">Daftar Harga Aktif</h3>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest italic">Review Master Data</p>
                            </div>
                            <i class="fas fa-list text-slate-200 text-xl"></i>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="bg-white">
                                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Layanan</th>
                                        <th class="px-8 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Harga Satuan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @forelse($services as $s)
                                    <tr class="hover:bg-indigo-50/30 transition-colors group">
                                        <td class="px-8 py-4">
                                            <span class="font-black text-slate-700 uppercase italic text-sm group-hover:text-indigo-600 transition-colors">{{ $s->name }}</span>
                                        </td>
                                        <td class="px-8 py-4 text-right">
                                            <span class="font-black text-indigo-600 text-sm italic">Rp {{ number_format($s->price, 0, ',', '.') }}</span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2" class="px-8 py-10 text-center">
                                            <p class="text-slate-300 font-black italic uppercase text-[10px] tracking-widest">Belum ada data.</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>