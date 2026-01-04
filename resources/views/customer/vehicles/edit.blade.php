<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-slate-800 tracking-tighter italic uppercase text-indigo-600">
            Edit Data Unit
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-12 px-4">
        <div class="bg-white p-10 rounded-[3.5rem] shadow-sm border border-slate-100 ring-1 ring-slate-900/5">
            
            <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST" class="space-y-6">
                @csrf 
                @method('PUT')
                
                {{-- Input Nomor Plat --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2 italic">Nomor Plat (Nomor Polisi)</label>
                    <input 
                        type="text" 
                        name="plate_number" 
                        value="{{ old('plate_number', $vehicle->plate_number) }}" 
                        required
                        oninput="this.value = this.value.toUpperCase()"
                        class="w-full px-8 py-6 bg-slate-50 border-none rounded-[2rem] focus:ring-2 focus:ring-indigo-500 font-black text-slate-800 text-2xl uppercase transition-all shadow-inner"
                    >
                    @error('plate_number')
                        <p class="text-[10px] font-bold text-rose-500 mt-1 ml-4 italic uppercase">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Input Merek & Tipe --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2 italic">Merek & Tipe Motor</label>
                    <input 
                        type="text" 
                        name="motor_type" 
                        value="{{ old('motor_type', $vehicle->motor_type) }}" 
                        required
                        class="w-full px-8 py-6 bg-slate-50 border-none rounded-[2rem] focus:ring-2 focus:ring-indigo-500 font-bold text-slate-600 italic transition-all shadow-inner"
                    >
                    @error('motor_type')
                        <p class="text-[10px] font-bold text-rose-500 mt-1 ml-4 italic uppercase">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <a href="{{ route('vehicles.index') }}" class="flex-1 text-center bg-slate-100 hover:bg-slate-200 text-slate-500 text-[10px] font-black py-6 rounded-[2rem] uppercase tracking-widest transition-all flex items-center justify-center">
                        Batal
                    </a>
                    <button type="submit" class="flex-[2] bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-black py-6 rounded-[2rem] shadow-xl shadow-indigo-100 uppercase tracking-widest transition-all group">
                        <i class="fas fa-sync-alt mr-2 group-hover:rotate-180 transition-transform duration-700"></i>
                        Update Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>