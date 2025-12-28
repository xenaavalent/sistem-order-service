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
                    <p class="text-xs text-slate-500 font-medium">Selamat datang, {{ Auth::user()->name }}</p>
                </div>
            </div>
            <span class="w-fit px-4 py-1.5 text-[10px] font-black text-indigo-600 bg-white border border-slate-200 rounded-full uppercase tracking-widest shadow-sm">
                Role: <span class="text-indigo-400">{{ Auth::user()->role }}</span>
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- ========================================== --}}
            {{-- TAMPILAN UNTUK ADMIN --}}
            {{-- ========================================== --}}
            @if(Auth::user()->role == 'admin')
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 transition-all hover:shadow-md hover:-translate-y-1">
                        <div class="flex justify-between items-start">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Pelanggan</p>
                            <div class="p-2 bg-slate-50 rounded-lg text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" stroke-width="2"/></svg>
                            </div>
                        </div>
                        <h3 class="text-4xl font-black text-slate-900 mt-2 tracking-tighter italic">{{ $totalPelanggan ?? 0 }}</h3>
                    </div>

                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 transition-all hover:shadow-md hover:-translate-y-1">
                        <div class="flex justify-between items-start">
                            <p class="text-[10px] font-black text-indigo-500 uppercase tracking-widest">Total Layanan</p>
                            <div class="p-2 bg-indigo-50 rounded-lg text-indigo-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-width="2"/></svg>
                            </div>
                        </div>
                        <h3 class="text-4xl font-black text-slate-900 mt-2 tracking-tighter italic">{{ $totalLayanan ?? 0 }}</h3>
                    </div>

                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 transition-all hover:shadow-md border-b-4 border-b-amber-400">
                        <div class="flex justify-between items-start">
                            <p class="text-[10px] font-black text-amber-600 uppercase tracking-widest">Sedang Proses</p>
                            <div class="p-2 bg-amber-50 rounded-lg text-amber-400 font-bold italic">!</div>
                        </div>
                        <h3 class="text-4xl font-black text-slate-900 mt-2 tracking-tighter italic">{{ $proses ?? 0 }}</h3>
                    </div>

                    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 transition-all hover:shadow-md border-b-4 border-b-emerald-400">
                        <div class="flex justify-between items-start">
                            <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Revenue (Selesai)</p>
                            <div class="p-2 bg-emerald-50 rounded-lg text-emerald-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z" stroke-width="2"/><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z" stroke-width="2"/></svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 mt-2 tracking-tighter italic">Rp{{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</h3>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-slate-100 ring-1 ring-slate-900/5 overflow-hidden">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="font-black text-slate-800 uppercase tracking-tight italic">Status Kendaraan Servis</h3>
                        <div class="flex gap-2">
                            <span class="w-3 h-3 rounded-full bg-indigo-500"></span>
                            <span class="w-3 h-3 rounded-full bg-emerald-400"></span>
                        </div>
                    </div>
                    <div class="h-[350px] w-full">
                        <canvas id="orderChart"></canvas>
                    </div>
                </div>

            {{-- ========================================== --}}
            {{-- TAMPILAN UNTUK CUSTOMER --}}
            {{-- ========================================== --}}
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-6">
                        {{-- Welcome Card --}}
                        <div class="bg-gradient-to-br from-indigo-600 to-violet-700 p-8 rounded-[2.5rem] text-white shadow-xl shadow-indigo-100 relative overflow-hidden group">
                            <div class="relative z-10">
                                <h3 class="text-3xl font-black italic uppercase tracking-tighter">Halo, {{ Auth::user()->name }}!</h3>
                                <p class="mt-2 text-indigo-100 font-medium opacity-80">Pantau perkembangan servis kendaraan Anda.</p>
                                
                                <div class="mt-8 flex items-center gap-4">
                                    <div class="bg-white/10 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/10">
                                        <p class="text-[9px] uppercase font-black text-indigo-200 mb-1">Status Terakhir</p>
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full animate-pulse bg-emerald-400"></span>
                                            <p class="text-lg font-bold italic uppercase tracking-tight">{{ $myOrders->first()->status ?? 'Belum Ada Servis' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/5 rounded-full group-hover:scale-110 transition-transform duration-700"></div>
                        </div>

                        {{-- Riwayat --}}
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 ring-1 ring-slate-900/5">
                            <h3 class="font-black text-slate-800 uppercase tracking-tight italic mb-6 flex items-center gap-2">
                                <span class="w-1.5 h-6 bg-indigo-500 rounded-full"></span>
                                Riwayat Servis
                            </h3>
                            <div class="space-y-4">
                                @forelse($myOrders ?? [] as $order)
                                    <div class="group flex items-center justify-between p-5 bg-slate-50 hover:bg-white hover:shadow-md transition-all rounded-3xl border border-transparent hover:border-slate-100">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 flex items-center justify-center rounded-2xl {{ strtolower($order->status) == 'done' ? 'bg-emerald-50 text-emerald-500' : 'bg-amber-50 text-amber-500' }}">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-width="2"/></svg>
                                            </div>
                                            <div>
                                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $order->service_date }}</p>
                                                <p class="font-black text-slate-800 italic uppercase">{{ $order->service->name ?? 'Servis' }}</p>
                                            </div>
                                        </div>
                                        <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest shadow-sm {{ strtolower($order->status) == 'done' ? 'bg-emerald-500 text-white' : 'bg-amber-400 text-white' }}">
                                            {{ $order->status }}
                                        </span>
                                    </div>
                                @empty
                                    <div class="text-center py-12">
                                        <div class="text-4xl mb-2 text-slate-200">☹</div>
                                        <p class="text-slate-400 italic font-bold uppercase text-xs tracking-widest">Belum ada riwayat servis</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar Info --}}
                    <div class="space-y-6">
                        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 ring-1 ring-slate-900/5">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-8 border-b border-slate-50 pb-4">Data Kendaraan</p>
                            <div class="space-y-8">
                                <div class="relative">
                                    <label class="text-[10px] font-bold text-indigo-400 uppercase italic block mb-1">Plat Nomor</label>
                                    <p class="text-3xl font-black text-slate-800 italic uppercase tracking-tighter">{{ Auth::user()->customer->plate_number ?? '-' }}</p>
                                    <div class="absolute -left-4 top-1/2 -translate-y-1/2 w-1 h-8 bg-indigo-500 rounded-full"></div>
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-slate-400 uppercase italic block mb-1">WhatsApp Terdaftar</label>
                                    <p class="text-lg font-bold text-slate-700">{{ Auth::user()->customer->phone ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

    {{-- Script Grafik --}}
    @if(Auth::user()->role == 'admin')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('orderChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['PROSES', 'SELESAI'], // Label diperbarui
                    datasets: [{
                        label: 'Jumlah Kendaraan',
                        data: [{{ $proses ?? 0 }}, {{ $done ?? 0 }}], 
                        backgroundColor: ['#6366f1', '#10b981'],
                        borderRadius: 15,
                        barThickness: 60,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            titleFont: { size: 13, weight: 'bold' },
                            padding: 12,
                            cornerRadius: 10
                        }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            grid: { color: '#f1f5f9', drawBorder: false },
                            ticks: { font: { weight: 'bold' }, color: '#94a3b8', stepSize: 1 }
                        },
                        x: { 
                            grid: { display: false },
                            ticks: { font: { weight: '900' }, color: '#64748b' }
                        }
                    }
                }
            });
        });
    </script>
    @endif
</x-app-layout>