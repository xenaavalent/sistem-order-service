<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl tracking-tighter uppercase text-indigo-600">Registrasi Antrean</h2>
    </x-slot>

    <div class="max-w-4xl mt-10 mx-auto px-4 pb-20">
        <div class="bg-white rounded-[2.5rem] shadow-2xl border border-slate-100 overflow-hidden">
            <div class="p-10">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Pemilik</label>
                            <select name="user_id" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl font-bold" required>
                                <option value="">-- Pilih Pelanggan --</option>
                                @foreach($users as $user) <option value="{{ $user->id }}">{{ $user->name }}</option> @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Plat Nomor</label>
                            <input type="text" name="plate_number" class="w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl font-bold uppercase" placeholder="B 1234 XXX" required>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Daftar Layanan Servis</label>
                        <div id="service-wrapper" class="space-y-4">
                            <div class="flex gap-4 service-row">
                                <select name="service_id[]" class="service-select w-full px-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl font-bold" required>
                                    <option value="" data-price="0">-- Pilih Layanan --</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" data-price="{{ $service->price }}">{{ $service->name }} — Rp {{ number_format($service->price, 0, ',', '.') }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="add-service px-6 bg-emerald-500 text-white rounded-2xl hover:bg-emerald-600 transition-all">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-6 border-t border-slate-50">
                        <div class="text-indigo-600 font-black text-xl" id="total_display">Total: Rp 0</div>
                        <button type="submit" class="bg-indigo-600 text-white px-10 py-4 rounded-2xl font-black uppercase tracking-widest text-xs shadow-xl">Simpan Antrean</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fungsi hitung total
            function calculateTotal() {
                let total = 0;
                $('.service-select').each(function() {
                    let price = $(this).find(':selected').data('price') || 0;
                    total += parseInt(price);
                });
                $('#total_display').text('Total: Rp ' + total.toLocaleString('id-ID'));
            }

            // Tambah baris baru
            $(document).on('click', '.add-service', function() {
                let newRow = $('.service-row:first').clone();
                newRow.find('select').val(''); // Reset pilihan
                newRow.find('button').removeClass('add-service bg-emerald-500').addClass('remove-service bg-red-500').html('<i class="fas fa-trash"></i>');
                $('#service-wrapper').append(newRow);
            });

            // Hapus baris
            $(document).on('click', '.remove-service', function() {
                $(this).closest('.service-row').remove();
                calculateTotal();
            });

            // Hitung saat select berubah
            $(document).on('change', '.service-select', function() {
                calculateTotal();
            });
        });
    </script>
    @endpush
</x-app-layout>