<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">Buat Order Servis Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-[2rem] border border-slate-100">
                <form action="{{ route('orders.store') }}" method="POST" class="p-8">
                    @csrf

                    <div class="mb-10">
                        <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-3">Identitas Pemilik</label>
                        <select name="customers_id" required class="w-full md:w-1/2 bg-slate-50 border-slate-200 rounded-2xl text-sm focus:ring-indigo-500 transition-all">
                            <option value="">-- Pilih Nama Pelanggan --</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-8 h-8 bg-indigo-500 rounded-lg flex items-center justify-center shadow-lg shadow-indigo-200">
                                <i class="fas fa-motorcycle text-white text-xs"></i>
                            </div>
                            <h3 class="text-sm font-bold text-slate-700 uppercase tracking-tight">Registrasi Plat Kendaraan</h3>
                        </div>

                        <div id="wrapper-kendaraan" class="space-y-4">
                            <div class="baris-kendaraan flex flex-col md:flex-row items-end gap-4 bg-slate-50/50 p-6 rounded-[1.5rem] border border-slate-100 transition-all">
                                <div class="flex-1 w-full">
                                    <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-2 ml-1">Nomor Polisi (Plat)</label>
                                    <input type="text" name="plate_numbers[]" required placeholder="Contoh: B 1234 ABC" 
                                           class="w-full bg-white border-slate-200 rounded-xl text-sm focus:ring-indigo-500 transition-all">
                                </div>

                                <div class="flex-1 w-full">
                                    <label class="block text-[10px] font-semibold text-slate-500 uppercase mb-2 ml-1">Jenis Layanan</label>
                                    <select name="service_ids[]" required class="w-full bg-white border-slate-200 rounded-xl text-sm focus:ring-indigo-500 transition-all">
                                        <option value="">-- Pilih Layanan --</option>
                                        @foreach($allServices as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="button" class="btn-hapus hidden p-2.5 text-slate-300 hover:text-rose-500 transition-colors mb-0.5">
                                    <i class="fas fa-trash-alt text-sm"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-center">
                            <button type="button" id="tambah-kendaraan" class="inline-flex items-center px-6 py-3 bg-white border border-slate-200 rounded-2xl text-[11px] font-bold text-indigo-600 uppercase tracking-widest hover:bg-slate-50 transition-all shadow-sm">
                                <i class="fas fa-plus-circle mr-2 text-sm"></i> Tambah Motor & Layanan
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-4 mt-10">
                        <button type="submit" class="bg-indigo-600 text-white px-8 py-4 rounded-2xl text-xs font-bold uppercase tracking-widest shadow-lg hover:bg-indigo-700 transition-all">
                            Simpan Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wrapper = document.getElementById('wrapper-kendaraan');
            const btnTambah = document.getElementById('tambah-kendaraan');

            btnTambah.addEventListener('click', function() {
                const barisAsal = document.querySelector('.baris-kendaraan');
                const barisBaru = barisAsal.cloneNode(true);

                barisBaru.querySelectorAll('input, select').forEach(el => el.value = '');
                barisBaru.querySelector('.btn-hapus').classList.remove('hidden');
                wrapper.appendChild(barisBaru);
            });

            wrapper.addEventListener('click', function(e) {
                if (e.target.closest('.btn-hapus')) {
                    e.target.closest('.baris-kendaraan').remove();
                }
            });
        });
    </script>
    @endpush
</x-app-layout>