<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-black text-2xl text-slate-800 tracking-tighter italic uppercase text-indigo-600 ml-0">
                Layanan Servis
            </h2>
        </div>
    </x-slot>

    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 ring-1 ring-slate-900/5 overflow-hidden mt-4">
        <div class="px-10 py-8 border-b border-slate-50 bg-slate-50/30 flex justify-between items-center">
            <h3 class="font-black text-slate-800 uppercase tracking-tight italic">
                {{ Auth::user()->role == 'admin' ? 'Kelola Master Layanan' : 'Daftar Harga Layanan' }}
            </h3>
            
            {{-- TOMBOL TAMBAH HANYA UNTUK ADMIN --}}
            @if(Auth::user()->role == 'admin')
            <a href="{{ route('services.create') }}" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-black py-3 px-6 rounded-2xl shadow-lg shadow-indigo-600/20 transition-all uppercase tracking-widest group">
                <i class="fas fa-plus mr-2 group-hover:rotate-90 transition-transform"></i> 
                <span>Tambah Layanan Baru</span>
            </a>
            @endif
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50/50 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-100">
                    <tr>
                        <th class="px-10 py-5 w-20">#</th>
                        <th class="px-10 py-5">Nama Layanan</th>
                        <th class="px-10 py-5">Harga Resmi</th>
                        {{-- KOLOM TINDAKAN HANYA UNTUK ADMIN --}}
                        @if(Auth::user()->role == 'admin')
                        <th class="px-10 py-5 text-center">Tindakan Kelola</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($services as $service)
                    <tr class="hover:bg-slate-50/50 transition-all group">
                        <td class="px-10 py-6 text-sm font-medium text-slate-400">{{ $loop->iteration }}</td>
                        
                        <td class="px-10 py-6">
                            <span class="text-sm font-bold text-slate-700 tracking-tight italic uppercase">
                                {{ $service->name }}
                            </span>
                        </td>
                        
                        <td class="px-10 py-6">
                            <span class="inline-flex items-center px-4 py-2 rounded-xl text-[11px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-100 shadow-sm">
                                Rp {{ number_format($service->price, 0, ',', '.') }}
                            </span>
                        </td>

                        {{-- AKSI EDIT/HAPUS HANYA UNTUK ADMIN --}}
                        @if(Auth::user()->role == 'admin')
                        <td class="px-10 py-6">
                            <div class="flex justify-center items-center space-x-3">
                                <a href="{{ route('services.edit', $service->id) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-amber-400 hover:bg-amber-500 text-white text-[10px] font-bold uppercase tracking-widest rounded-xl transition-all">
                                    Ubah
                                </a>
                                <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="m-0 p-0" onsubmit="return confirm('Hapus layanan?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-rose-500 hover:bg-rose-600 text-white text-[10px] font-bold uppercase tracking-widest rounded-xl transition-all">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ Auth::user()->role == 'admin' ? 4 : 3 }}" class="px-10 py-20 text-center text-slate-400 italic font-bold uppercase text-xs tracking-widest">
                            Belum ada data layanan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>