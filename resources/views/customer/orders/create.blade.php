<x-app-layout>
    <x-slot name="header">
      
        <h2 class="font-black text-3xl text-slate-800 tracking-tighter italic uppercase text-center pt-4">
            Booking Servis
        </h2>
    </x-slot>

    {{-- REVISI: Mengatur mt-6 agar container form naik dan sejajar dengan desain dashboard --}}
    <div class="max-w-2xl mx-auto mt-6 px-4 pb-20">
        <div class="bg-white p-10 rounded-[3.5rem] shadow-sm border border-slate-100 ring-1 ring-slate-900/5">
            
            <form action="{{ route('orders.store') }}" method="POST" id="bookingForm">
                @csrf
                
                {{-- 1. Pilih Motor --}}
                <div class="mb-10">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2 mb-3 block italic">Pilih Motor Dari Garasi</label>
                    <div class="relative">
                        <select name="vehicle_id" required class="w-full rounded-[2rem] border-2 border-indigo-100 bg-slate-50 py-5 px-8 font-black text-slate-700 italic uppercase tracking-tighter focus:ring-4 focus:ring-indigo-50 focus:border-indigo-400 transition-all appearance-none cursor-pointer">
                            @if($myVehicles->isEmpty())
                                <option value="" disabled selected>-- GARASI ANDA KOSONG --</option>
                            @else
                                <option value="" disabled selected>-- PILIH UNIT ANDA --</option>
                                @foreach($myVehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->plate_number }} - {{ $vehicle->motor_type }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <div class="absolute right-8 top-1/2 -translate-y-1/2 pointer-events-none text-indigo-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    @if($myVehicles->isEmpty())
                        <div class="mt-4 p-4 bg-amber-50 rounded-2xl border border-amber-100 flex items-center gap-3">
                            <span class="text-amber-500 text-lg">⚠️</span>
                            <p class="text-[10px] text-amber-700 font-bold italic uppercase tracking-tight">
                                Anda belum mendaftarkan kendaraan. 
                                <a href="{{ route('vehicles.create') }}" class="text-indigo-600 underline decoration-2">Klik di sini untuk tambah motor.</a>
                            </p>
                        </div>
                    @else
                        <p class="text-[9px] text-slate-400 mt-3 ml-4 italic font-medium">
                            *Punya motor baru? <a href="{{ route('vehicles.create') }}" class="text-indigo-600 font-bold hover:underline">Tambah di Garasi</a>
                        </p>
                    @endif
                </div>

                {{-- 2. Pilih Layanan --}}
                <div class="mb-10">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2 mb-4 block italic">Pilih Jenis Layanan</label>
                    <div class="grid grid-cols-1 gap-3">
                        @foreach($allServices as $service)
                            <label class="group relative flex items-center justify-between p-6 bg-slate-50 rounded-[1.5rem] border-2 border-transparent hover:border-indigo-200 hover:bg-white transition-all cursor-pointer shadow-sm hover:shadow-md has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50/30">
                                <div class="flex items-center gap-4">
                                    <input type="checkbox" name="service_ids[]" value="{{ $service->id }}" 
                                        data-price="{{ $service->price }}"
                                        {{ is_array(old('service_ids')) && in_array($service->id, old('service_ids')) ? 'checked' : '' }}
                                        class="service-checkbox w-6 h-6 text-indigo-600 border-2 border-slate-300 rounded-lg focus:ring-indigo-500 transition-all cursor-pointer">
                                    <span class="font-black text-slate-700 uppercase italic tracking-tighter group-hover:text-indigo-700">{{ $service->name }}</span>
                                </div>
                                <span class="font-black text-indigo-600 italic">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('service_ids')
                        <p class="text-[10px] font-bold text-rose-500 mt-2 ml-4 italic uppercase">Pilih minimal satu layanan</p>
                    @enderror
                </div>

                {{-- 3. Catatan --}}
                <div class="mb-10">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2 mb-3 block italic">Keluhan atau Permintaan Khusus</label>
                    <textarea name="notes" rows="3" placeholder="Contoh: Bunyi di CVT, cek rem depan, dll..." 
                        class="w-full rounded-[2rem] border-2 border-slate-100 bg-slate-50 py-5 px-8 font-bold text-slate-600 focus:ring-4 focus:ring-indigo-50 focus:border-indigo-200 transition-all italic placeholder:text-slate-300">{{ old('notes') }}</textarea>
                </div>

                {{-- 4. Ringkasan & Submit --}}
                <div class="pt-6 border-t border-slate-100">
                    <div class="flex justify-between items-center mb-8 px-4">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Estimasi Total</span>
                        <div class="text-right">
                            <span class="block font-black text-3xl text-indigo-600 italic tracking-tighter" id="displayTotalPrice">Rp 0</span>
                            <input type="hidden" name="total_price" id="inputTotalPrice" value="0">
                        </div>
                    </div>

                    <button type="submit" id="submitBtn" @if($myVehicles->isEmpty()) disabled @endif class="w-full {{ $myVehicles->isEmpty() ? 'bg-slate-300 cursor-not-allowed' : 'bg-indigo-600 hover:bg-indigo-700' }} text-white font-black py-6 rounded-[2.5rem] shadow-2xl shadow-indigo-200 transition-all uppercase tracking-[0.2em] text-xs flex items-center justify-center group">
                        Konfirmasi Booking
                        <svg class="w-4 h-4 ml-3 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.service-checkbox');
            const displayPrice = document.getElementById('displayTotalPrice');
            const inputPrice = document.getElementById('inputTotalPrice');
            const submitBtn = document.getElementById('submitBtn');

            function calculateTotal() {
                let total = 0;
                let checkedCount = 0;

                checkboxes.forEach(cb => {
                    if (cb.checked) {
                        total += parseInt(cb.getAttribute('data-price'));
                        checkedCount++;
                    }
                });
                
                displayPrice.innerText = 'Rp ' + total.toLocaleString('id-ID');
                inputPrice.value = total;

                @if(!$myVehicles->isEmpty())
                    if (checkedCount === 0) {
                        submitBtn.disabled = true;
                        submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                    } else {
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    }
                @endif
            }

            checkboxes.forEach(cb => {
                cb.addEventListener('change', calculateTotal);
            });

            calculateTotal();
        });
    </script>
</x-app-layout>