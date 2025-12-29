<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl tracking-tighter uppercase text-indigo-600">Formulir Antrean Servis</h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <style>
        .premium-card { @apply bg-white rounded-[2.5rem] shadow-2xl border border-slate-100 overflow-hidden; }
        .input-group { @apply space-y-2; }
        .premium-input {
            @apply w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 focus:bg-white transition-all font-bold text-slate-700 text-sm placeholder:text-slate-300 outline-none;
        }
        .premium-label { @apply text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1 block; }
        * { font-style: normal !important; }
    </style>

    <div class="max-w-5xl mt-10 mx-auto px-4 pb-20">
        <div class="premium-card">
            <div class="px-10 py-8 border-b border-slate-50 bg-slate-50/30 flex justify-between items-center">
                <div>
                    <h3 class="font-black text-slate-800 uppercase tracking-tighter text-xl">Registrasi Kendaraan</h3>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Daftarkan motor baru untuk akun pemilik terpilih</p>
                </div>
                <i class="fas fa-motorcycle text-3xl text-indigo-100"></i>
            </div>

            <div class="p-10">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="space-y-10">
                        
                        <div class="max-w-md input-group">
                            <label class="premium-label">Identitas Pemilik</label>
                            <select name="user_id" id="user_id" class="premium-input cursor-pointer" required>
                                <option value="">-- Pilih Nama Pelanggan --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-6 bg-slate-50/50 p-8 rounded-[2rem] border border-slate-100">
                            <div class="flex items-center space-x-3 mb-2">
                                <span class="bg-indigo-600 p-2 rounded-lg">
                                    <i class="fas fa-plus text-white text-[10px]"></i>
                                </span>
                                <h4 class="text-[11px] font-black text-slate-800 uppercase tracking-widest">Informasi Kendaraan Baru</h4>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="input-group">
                                    <label class="premium-label">Plat Nomor Baru</label>
                                    <input type="text" name="plate_number" class="premium-input uppercase text-indigo-600" placeholder="CONTOH: B 1234 XXX" required>
                                </div>
                                <div class="input-group">
                                    <label class="premium-label">Merk Kendaraan</label>
                                    <input type="text" name="brand" class="premium-input" placeholder="MISAL: HONDA" required>
                                </div>
                                <div class="input-group">
                                    <label class="premium-label">Tipe / Model</label>
                                    <input type="text" name="type" class="premium-input" placeholder="MISAL: VARIO 160" required>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-end">
                            <div class="md:col-span-2 input-group">
                                <div class="flex justify-between items-center mb-1">
                                    <label class="premium-label">Jenis Layanan</label>
                                    <span id="counter" class="text-[9px] font-black text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full uppercase">0 Terpilih</span>
                                </div>
                                <select name="service_id[]" id="service_multichoose" class="w-full" multiple="multiple" required>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">
                                            {{ $service->name }} — Rp {{ number_format($service->price, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group">
                                <label class="premium-label">Status Antrean</label>
                                <select name="status" class="premium-input !text-orange-500 font-black">
                                    <option value="pending">ANTRE / PROSES</option>
                                    <option value="done">SELESAI</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-6 border-t border-slate-50">
                            <div class="input-group">
                                <label class="premium-label">Tgl. Kedatangan</label>
                                <input type="date" name="service_date" value="{{ date('Y-m-d') }}" class="premium-input">
                            </div>
                            <button type="submit" class="bg-indigo-600 text-white text-[11px] font-black py-5 px-10 rounded-2xl shadow-xl uppercase tracking-widest hover:bg-indigo-700 transition-all self-end">
                                Daftarkan Antrean <i class="fas fa-check-circle ml-2"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#service_multichoose').select2({ placeholder: " Cari layanan servis motor...", width: '100%' });
            
            $('#service_multichoose').on('change', function() {
                const total = $(this).val() ? $(this).val().length : 0;
                $('#counter').text(total + ' Terpilih');
            });
        });
    </script>
</x-app-layout>