<x-app-layout>
    {{-- Header Tetap Bersih --}}
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-800 tracking-tighter italic uppercase text-indigo-600">
            Kendaraan
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        {{-- AREA UTAMA DENGAN BACKGROUND PUTIH --}}
        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 p-8 relative min-h-[500px]">
            
            {{-- HEADER DI DALAM CARD --}}
            <div class="flex justify-between items-center mb-10">
                <h3 class="font-black text-slate-800 uppercase tracking-tight italic text-sm flex items-center">
                    <span class="w-2 h-6 bg-indigo-600 rounded-full mr-3"></span>
                    {{ Auth::user()->role == 'admin' ? 'Daftar Semua Kendaraan' : 'Garasi Saya' }}
                </h3>

                {{-- TOMBOL TAMBAH UNIT --}}
                <a href="{{ route('vehicles.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-black py-3 px-6 rounded-2xl shadow-lg shadow-indigo-100 transition-all uppercase tracking-widest flex items-center group">
                    <span class="mr-2 text-base group-hover:rotate-90 transition-transform duration-300">+</span> 
                    Tambah Unit
                </a>
            </div>

            {{-- GRID CARD KENDARAAN --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($vehicles as $vehicle)
                <div class="bg-slate-50 p-8 rounded-[2.5rem] border border-slate-100 transition-all hover:shadow-md hover:bg-white group relative overflow-hidden">
                    {{-- Ikon & Aksi --}}
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-indigo-600 shadow-sm group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                            <i class="fas fa-motorcycle text-2xl"></i>
                        </div>
                        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="w-8 h-8 bg-amber-400 text-white rounded-lg flex items-center justify-center hover:bg-amber-500 transition-colors shadow-sm">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('Hapus unit ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-8 h-8 bg-rose-500 text-white rounded-lg flex items-center justify-center hover:bg-rose-600 transition-colors shadow-sm">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Data Kendaraan --}}
                    <div class="relative z-10">
                        <p class="text-[9px] font-black text-indigo-400 uppercase tracking-[0.2em] mb-1">Nomor Polisi</p>
                        <h3 class="text-3xl font-black text-slate-800 italic uppercase tracking-tighter mb-1">
                            {{ $vehicle->plate_number }}
                        </h3>
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-tight italic">{{ $vehicle->motor_type }}</p>
                    </div>

                    {{-- Info Pemilik (Muncul Jika Admin) --}}
                    @if(Auth::user()->role == 'admin')
                    <div class="mt-6 pt-5 border-t border-slate-200/50">
                        <p class="text-[9px] font-bold text-slate-400 uppercase italic flex items-center">
                            <i class="fas fa-user-circle mr-2 text-indigo-300"></i> 
                            Owner: <span class="ml-1 text-slate-600">{{ $vehicle->user->name ?? 'Anonim' }}</span>
                        </p>
                    </div>
                    @endif
                    
                    {{-- Background Decoration --}}
                    <div class="absolute -bottom-4 -right-4 text-slate-100 text-8xl transition-transform group-hover:scale-110 group-hover:text-indigo-50/50">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center">
                    <div class="inline-flex w-20 h-20 bg-slate-50 rounded-full items-center justify-center mb-4 text-slate-200">
                        <i class="fas fa-motorcycle text-3xl"></i>
                    </div>
                    <p class="text-slate-400 font-black italic uppercase text-xs tracking-widest">Belum ada kendaraan terdaftar</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>