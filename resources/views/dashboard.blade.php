<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-indigo-600 rounded-xl shadow-lg shadow-indigo-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-black text-2xl text-slate-800 tracking-tighter italic uppercase">
                        {{ Auth::user()->role == 'customer' ? 'Dashboard Pelanggan' : 'Ringkasan Sistem' }}
                    </h2>
                    <p class="text-xs text-slate-500 font-medium italic">Selamat datang, {{ Auth::user()->name }}</p>
                </div>
            </div>
            <span class="w-fit px-4 py-1.5 text-[10px] font-black text-indigo-600 bg-white border border-slate-200 rounded-full uppercase tracking-widest shadow-sm">
                Role: <span class="text-indigo-400">{{ Auth::user()->role }}</span>
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- SECTION ADMIN --}}
            @if(Auth::user()->role == 'admin')
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 transition-all hover:shadow-md">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Pelanggan</p>
                        <h3 class="text-4xl font-black text-slate-900 mt-2 tracking-tighter italic">{{ $totalPelanggan ?? 0 }}</h3>
                    </div>

                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 transition-all hover:shadow-md">
                        <p class="text-[10px] font-black text-indigo-500 uppercase tracking-widest">Total Layanan</p>
                        <h3 class="text-4xl font-black text-slate-900 mt-2 tracking-tighter italic">{{ $totalLayanan ?? 0 }}</h3>
                    </div>

                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 transition-all hover:shadow-md border-b-4 border-b-amber-400">
                        <p class="text-[10px] font-black text-amber-600 uppercase tracking-widest">Sedang Proses</p>
                        <h3 class="text-4xl font-black text-slate-900 mt-2 tracking-tighter italic">{{ $sedangProses ?? 0 }}</h3>
                    </div>

                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 transition-all hover:shadow-md border-b-4 border-b-emerald-400">
                        <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Revenue (Selesai)</p>
                        <h3 class="text-xl font-black text-slate-900 mt-2 tracking-tighter italic">Rp{{ number_format($revenueSelesai ?? 0, 0, ',', '.') }}</h3>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-slate-100">
                    <h3 class="font-black text-slate-800 uppercase tracking-tight italic mb-8 flex items-center gap-2">
                        <span class="w-2 h-6 bg-indigo-600 rounded-full"></span>
                        Status Kendaraan Servis
                    </h3>
                    <div class="h-[350px] w-full">
                        <canvas id="orderChart"></canvas>
                    </div>
                </div>

            {{-- SECTION CUSTOMER --}}
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-gradient-to-br from-indigo-600 to-violet-700 p-8 rounded-[2.5rem] text-white shadow-xl relative overflow-hidden group">
                            <div class="relative z-10">
                                <h3 class="text-3xl font-black italic uppercase tracking-tighter">Halo, {{ Auth::user()->name }}!</h3>
                                <p class="mt-2 text-indigo-100 font-medium opacity-80 italic">Pantau perkembangan servis kendaraan Anda di SIMBENGKEL.</p>
        
                            </div>
                            <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/5 rounded-full group-hover:scale-110 transition-transform"></div>
                        </div>

                        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                            <h3 class="font-black text-slate-800 uppercase tracking-tight italic mb-6 flex items-center gap-2">
                                <span class="w-1.5 h-6 bg-emerald-500 rounded-full"></span>
                                Aktivitas Servis Terakhir
                            </h3>
                            <div class="space-y-4">
                                @forelse($myOrders ?? [] as $order)
                                    <div class="flex items-center justify-between p-5 bg-slate-50 rounded-3xl border border-slate-100 hover:bg-white hover:shadow-md transition-all">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 flex items-center justify-center rounded-2xl {{ strtolower($order->status ?? '') == 'selesai' ? 'bg-emerald-50 text-emerald-500' : 'bg-amber-50 text-amber-500' }}">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                            </div>
                                            <div>
                                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ $order->created_at->format('d M Y') }} • {{ $order->vehicle->plate_number ?? 'No Plate' }}</p>
                                                <p class="font-black text-slate-800 italic uppercase">{{ $order->vehicle->motor_type ?? 'Unit Servis' }}</p>
                                            </div>
                                        </div>
                                        <span class="px-4 py-1.5 rounded-full text-[8px] font-black uppercase tracking-widest {{ strtolower($order->status ?? '') == 'selesai' ? 'bg-emerald-500' : 'bg-amber-500' }} text-white italic">
                                            {{ $order->status ?? 'Unknown' }}
                                        </span>
                                    </div>
                                @empty
                                    <div class="text-center py-10">
                                        <p class="text-slate-400 italic font-bold uppercase text-[10px] tracking-widest">Belum ada riwayat servis ditemukan</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6 border-b pb-4 italic">Unit Aktif</p>
                            <div class="space-y-6">
                                @php 
                                    $activeOrders = collect($myOrders ?? [])->filter(function($o) {
                                        return in_array(strtolower($o->status ?? ''), ['pending', 'proses']);
                                    });
                                @endphp
                                @forelse($activeOrders as $active)
                                    <div class="relative pl-4 border-l-2 border-indigo-500">
                                        <label class="text-[9px] font-bold text-indigo-400 uppercase italic block mb-1 tracking-widest">ID: #{{ $active->id }}</label>
                                        <p class="text-lg font-black text-slate-800 italic uppercase tracking-tighter">{{ $active->vehicle->plate_number ?? 'N/A' }}</p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                                            <p class="text-[9px] font-black text-amber-600 uppercase italic tracking-widest">{{ $active->status }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-[9px] font-black text-slate-300 uppercase italic text-center py-4">Tidak ada unit di bengkel</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Script Chart (Admin) --}}
    @if(Auth::user()->role == 'admin')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('orderChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['PROSES', 'SELESAI'],
                    datasets: [{
                        label: 'Jumlah Unit',
                        data: [{{ $sedangProses ?? 0 }}, {{ $countSelesai ?? 0 }}], 
                        backgroundColor: ['#fbbf24', '#10b981'],
                        borderRadius: 20,
                        barThickness: 60,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, ticks: { stepSize: 1 } },
                        x: { grid: { display: false } }
                    }
                }
            });
        });
    </script>
    @endif
</x-app-layout>