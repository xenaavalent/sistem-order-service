<x-app-layout>
    {{-- Header --}}
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                Input Order Baru
            </h2>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-slate-200">
            
            <div class="px-8 py-6 border-b border-slate-100 bg-slate-50">
                <h3 class="text-lg font-medium text-slate-700">Detail Antrean Servis</h3>
            </div>

            <div class="p-8">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Pilih Pelanggan --}}
                        <div class="md:col-span-2">
                            <label class="block font-medium text-sm text-slate-600 mb-2">
                                Nama Pelanggan (Member)
                            </label>
                            <select name="customer_id" id="customer_select" class="w-full rounded-md shadow-sm border-slate-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-slate-600">
                                <option value="" data-plate="">-- Pilih Member --</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" 
                                            data-plate="{{ $customer->plate_number }}"
                                            {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Input Plat Nomor --}}
                        <div class="md:col-span-2">
                            <label class="block font-medium text-sm text-slate-600 mb-2">
                                Plat Nomor Kendaraan
                            </label>
                            <input 
                                type="text" 
                                name="plate_number" 
                                id="plate_number_input"
                                value="{{ old('plate_number') }}"
                                placeholder="Contoh: B 1234 ABC"
                                class="w-full rounded-md shadow-sm border-slate-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-slate-600"
                                required
                            >
                            <p class="text-xs text-slate-400 mt-1">*Ubah plat nomor jika pelanggan membawa kendaraan berbeda.</p>
                        </div>

                        {{-- Pilih Layanan --}}
                        <div class="md:col-span-2">
                            <label class="block font-medium text-sm text-slate-600 mb-2">
                                Jenis Layanan Servis
                            </label>
                            <select name="service_id" class="w-full rounded-md shadow-sm border-slate-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-slate-600">
                                <option value="">-- Pilih Layanan --</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }} — Rp {{ number_format($service->price, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tanggal --}}
                        <div>
                            <label class="block font-medium text-sm text-slate-600 mb-2">
                                Tanggal Kedatangan
                            </label>
                            <input 
                                type="date" 
                                name="service_date" 
                                value="{{ old('service_date', date('Y-m-d')) }}"
                                class="w-full rounded-md shadow-sm border-slate-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-slate-600"
                            >
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="block font-medium text-sm text-slate-600 mb-2">
                                Status Pengerjaan
                            </label>
                            <select name="status" class="w-full rounded-md shadow-sm border-slate-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-slate-600">
                                <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending (Proses)</option>
                                <option value="done" {{ old('status') === 'done' ? 'selected' : '' }}>Done (Selesai)</option>
                            </select>
                        </div>

                        {{-- Tombol --}}
                        <div class="md:col-span-2 flex items-center justify-end space-x-4 mt-6">
                            <a href="{{ route('orders.index') }}" class="text-sm text-slate-500 hover:text-slate-700 underline">Batal</a>
                            <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Validasi Order
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('customer_select').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const plateNumber = selectedOption.getAttribute('data-plate');
            document.getElementById('plate_number_input').value = plateNumber;
        });
    </script>
</x-app-layout>