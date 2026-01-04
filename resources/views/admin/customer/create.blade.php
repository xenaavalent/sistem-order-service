<x-app-layout>
    {{-- Header Judul --}}
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-black text-2xl text-slate-800 tracking-tighter italic uppercase text-indigo-600 ml-0">
                Registrasi Pelanggan
            </h2>
        </div>
    </x-slot>

    {{-- Container agar ukuran card proporsional --}}
    <div class="max-w-4xl mt-4">
        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 ring-1 ring-slate-900/5 overflow-hidden">
            
            {{-- Header Form --}}
            <div class="px-10 py-8 border-b border-slate-50 bg-slate-50/30 flex justify-between items-center">
                <h3 class="font-black text-slate-800 uppercase tracking-tight italic">Tambah Member Baru</h3>
            </div>

            <div class="p-10">
                <form action="{{ route('customers.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 gap-8">
                        {{-- Input Nama --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                                Nama Lengkap
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                value="{{ old('name') }}"
                                class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 font-medium text-slate-600 placeholder-slate-300 transition-all"
                                placeholder="Masukkan nama pelanggan"
                                required
                            >
                            @error('name')
                                <p class="text-rose-500 text-[10px] font-bold mt-2 ml-2 uppercase italic tracking-wider">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Input No HP --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                                No. Handphone (WhatsApp)
                            </label>
                            <input 
                                type="text" 
                                name="phone" 
                                value="{{ old('phone') }}"
                                class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 font-medium text-slate-600 placeholder-slate-300 transition-all"
                                placeholder="Contoh: 0812xxxx"
                            >
                            @error('phone')
                                <p class="text-rose-500 text-[10px] font-bold mt-2 ml-2 uppercase italic tracking-wider">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Input Email (WAJIB UNTUK LOGIN) --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                                Alamat Email (Untuk Login)
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 font-medium text-slate-600 placeholder-slate-300 transition-all"
                                placeholder="Masukkan email pelanggan"
                                required
                            >
                            @error('email')
                                <p class="text-rose-500 text-[10px] font-bold mt-2 ml-2 uppercase italic tracking-wider">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Input Password --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">
                                Password Login
                            </label>
                            <div class="relative">
                                <input 
                                    id="password"
                                    type="password" 
                                    name="password" 
                                    class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 font-medium text-slate-600 transition-all"
                                    placeholder="Buat password minimal 6 karakter"
                                    required
                                >
                                <button type="button" onclick="togglePassword()" class="absolute right-6 top-4 text-[10px] font-black uppercase text-slate-400 hover:text-indigo-600 transition-colors">
                                    <span id="eye-icon">Tampilkan</span>
                                </button>
                            </div>
                            @error('password')
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
                                    class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-black py-4 px-10 rounded-2xl shadow-lg shadow-indigo-600/20 transition-all uppercase tracking-widest group">
                                <i class="fas fa-save mr-2 group-hover:scale-110 transition-transform"></i>
                                <span>Simpan Pelanggan</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function togglePassword() {
        const passInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        
        if (passInput.type === 'password') {
            passInput.type = 'text';
            eyeIcon.innerText = 'Sembunyikan';
        } else {
            passInput.type = 'password';
            eyeIcon.innerText = 'Tampilkan';
        }
    }
    </script>
</x-app-layout>