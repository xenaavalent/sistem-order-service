<x-app-layout>
    {{-- Header Judul --}}
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-black text-2xl text-slate-800 tracking-tighter italic uppercase text-indigo-600 ml-0">
                Update Order Servis
            </h2>
        </div>
    </x-slot>

    {{-- Container Proporsional --}}
    <div class="max-w-4xl mt-4 mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 ring-1 ring-slate-900/5 overflow-hidden">
            
            {{-- Header Card --}}
            <div class="px-10 py-8 border-b border-slate-50 bg-slate-50/30">
                <h3 class="font-black text-slate-800 uppercase tracking-tight italic">Edit Transaksi #{{ $order->id }}</h3>
            </div>

            <div class="p-10">
                <form action="{{ route('orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-8">
                        
                        {{-- Pilih Pelanggan --}}
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Nama Pelanggan</label>
                            <select name="customers_id" required class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 font-bold text-slate-600 transition-all cursor-pointer">
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ $order->customers_id == $customer->id ? 'selected' : '' }}>
                                        {{ strtoupper($customer->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Section Kendaraan & Layanan --}}
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Detail Kendaraan & Layanan</label>
                                <button type="button" id="tambah-kendaraan" class="text-[10px] font-black text-indigo-600 uppercase hover:text-indigo-800">+ Tambah Motor</button>
                            </div>

                            <div id="wrapper-kendaraan" class="space-y-4">
                                @php 
                                    $plates = explode(', ', $order->plate_number);
                                    $service_ids = explode(', ', $order->service_id);
                                @endphp

                                @foreach($plates as $index => $plate)
                                <div class="baris-kendaraan flex flex-col md:flex-row gap-4 bg-slate-50/50 p-6 rounded-[1.5rem] border border-slate-100 relative">
                                    <div class="flex-1">
                                        <input type="text" name="plate_numbers[]" value="{{ trim($plate) }}" required placeholder="PLAT NOMOR" 
                                               class="w-full bg-white border-slate-200 rounded-xl text-sm font-bold focus:ring-indigo-500 uppercase">
                                    </div>
                                    <div class="flex-1">
                                        <select name="service_ids[]" required class="w-full bg-white border-slate-200 rounded-xl text-sm font-bold text-indigo-600">
                                            @foreach($allServices as $service)
                                                <option value="{{ $service->id }}" {{ (isset($service_ids[$index]) && $service_ids[$index] == $service->id) ? 'selected' : '' }}>
                                                    {{ strtoupper($service->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if($index > 0)
                                    <button type="button" class="btn-hapus text-rose-500 text-xs font-bold uppercase">Hapus</button>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            {{-- Tanggal --}}
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Tanggal</label>
                                <input type="date" name="service_date" value="{{ $order->service_date }}" class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl font-medium text-slate-600">
                            </div>

                            {{-- Status --}}
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Status Pengerjaan</label>
                                <select name="status" class="w-full px-6 py-4 bg-slate-50 border-slate-100 rounded-2xl font-bold text-slate-600">
                                    <option value="proses" {{ $order->status === 'proses' ? 'selected' : '' }}>🕒 PROSES</option>
                                    <option value="done" {{ $order->status === 'done' ? 'selected' : '' }}>✅ SELESAI</option>
                                </select>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex items-center justify-end space-x-6 pt-6">
                            <a href="{{ route('orders.index') }}" class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-slate-600 transition-all">Kembali</a>
                            <button type="submit" class="inline-flex items-center bg-amber-500 hover:bg-amber-600 text-white text-[10px] font-black py-4 px-10 rounded-3xl shadow-lg shadow-amber-600/20 transition-all uppercase tracking-widest group">
                                <i class="fas fa-sync-alt mr-2 group-hover:rotate-180 transition-transform duration-700"></i>
                                <span>Perbarui Transaksi</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('tambah-kendaraan').addEventListener('click', function() {
            const wrapper = document.getElementById('wrapper-kendaraan');
            const baris = document.querySelector('.baris-kendaraan').cloneNode(true);
            baris.querySelectorAll('input').forEach(i => i.value = '');
            
            // Tambahkan tombol hapus jika belum ada
            if(!baris.querySelector('.btn-hapus')) {
                const btnHapus = document.createElement('button');
                btnHapus.type = 'button';
                btnHapus.className = 'btn-hapus text-rose-500 text-xs font-bold uppercase';
                btnHapus.innerText = 'Hapus';
                baris.appendChild(btnHapus);
            }
            
            wrapper.appendChild(baris);
        });

        document.getElementById('wrapper-kendaraan').addEventListener('click', function(e) {
            if(e.target.classList.contains('btn-hapus')) {
                e.target.closest('.baris-kendaraan').remove();
            }
        });
    </script>
</x-app-layout>