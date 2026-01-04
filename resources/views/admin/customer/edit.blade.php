<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-black text-2xl text-slate-800 tracking-tighter italic uppercase text-indigo-600 ml-0">
                Edit Data Pelanggan
            </h2>
        </div>
    </x-slot>

    <div class="max-w-4xl mt-4">
        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 ring-1 ring-slate-900/5 overflow-hidden">
            
            <div class="px-10 py-8 border-b border-slate-50 bg-slate-50/30 flex justify-between items-center">
                <div>
                    <h3 class="font-black text-slate-800 uppercase tracking-tight italic">Ubah Profil Member</h3>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">ID Pelanggan: #{{ $customer->id }}</p>
                </div>
                <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600">
                    <i class="fas fa-user-edit text-lg"></i>
                </div>
            </div>

            <div class="p-10">
                <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Nama Lengkap --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $customer->name) }}" required
                                class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 font-medium text-slate-600 transition-all">
                        </div>

                        {{-- No. Handphone (WhatsApp) --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">No. Handphone (WhatsApp)</label>
                            <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}"
                                class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 font-medium text-slate-600 transition-all"
                                placeholder="Contoh: 0812xxxx">
                        </div>

                        {{-- Alamat Email --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Alamat Email (Login)</label>
                            <input type="email" name="email" value="{{ old('email', $customer->email) }}" required
                                class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 font-medium text-slate-600 transition-all">
                        </div>

                        {{-- Ganti Password --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-amber-500 uppercase tracking-[0.2em] ml-1">Ganti Password</label>
                            <div class="relative">
                                <input id="password" type="password" name="password" 
                                    class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-2 focus:ring-amber-500 font-medium text-slate-600 transition-all"
                                    placeholder="••••••••">
                                <button type="button" onclick="togglePassword()" class="absolute right-6 top-4 text-[10px] font-black uppercase text-slate-400 hover:text-amber-600">
                                    <span id="eye-icon">Tampilkan</span>
                                </button>
                            </div>
                            <p class="text-[9px] text-slate-400 font-bold italic ml-2">*Kosongkan jika tidak ingin ganti</p>
                        </div>
                    </div>

                    {{-- Tombol Navigasi --}}
                    <div class="flex items-center justify-end space-x-4 mt-12 pt-6 border-t border-slate-50">
                        <a href="{{ route('customers.index') }}" 
                           class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-slate-600 transition-all">
                            Batal
                        </a>
                        
                        <button type="submit" 
                                class="inline-flex items-center bg-amber-500 hover:bg-amber-600 text-white text-[10px] font-black py-4 px-10 rounded-2xl shadow-lg shadow-amber-600/20 transition-all uppercase tracking-widest group">
                            <i class="fas fa-sync-alt mr-2 group-hover:rotate-180 transition-transform duration-500"></i>
                            <span>Update Pelanggan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function togglePassword() {
        const passInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        passInput.type = passInput.type === 'password' ? 'text' : 'password';
        eyeIcon.innerText = passInput.type === 'password' ? 'Tampilkan' : 'Sembunyikan';
    }
    </script>
</x-app-layout>