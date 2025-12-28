<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIMB | Modern Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="h-full antialiased text-slate-900 overflow-x-hidden">
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <aside class="hidden lg:flex lg:w-72 lg:flex-col fixed inset-y-0 bg-slate-900 shadow-2xl z-50">
            <div class="flex flex-col flex-grow pt-8 overflow-y-auto">
                <div class="flex items-center flex-shrink-0 px-8 mb-10">
                    <div class="w-8 h-8 bg-indigo-500 rounded-lg mr-3 shadow-lg shadow-indigo-500/50"></div>
                    <span class="text-xl font-black text-white tracking-tighter italic">SIM<span class="text-indigo-400 font-light">BENGKEL</span></span>
                </div>
                
                <nav class="flex-1 px-4 space-y-1">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3.5 text-sm font-bold rounded-2xl transition-all {{ request()->routeIs('dashboard') ? 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                    </a>

                    <div class="pt-6 pb-2 px-6 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Master Data</div>
                    <a href="{{ route('services.index') }}" class="flex items-center px-6 py-3.5 text-sm font-bold rounded-2xl transition-all {{ request()->routeIs('services.*') ? 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-wrench mr-3"></i> Layanan Servis
                    </a>
                    <a href="{{ route('customers.index') }}" class="flex items-center px-6 py-3.5 text-sm font-bold rounded-2xl transition-all {{ request()->routeIs('customers.*') ? 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-users mr-3"></i> Pelanggan
                    </a>

                    <div class="pt-6 pb-2 px-6 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Transaksi</div>
                    <a href="{{ route('orders.index') }}" class="flex items-center px-6 py-3.5 text-sm font-bold rounded-2xl transition-all {{ request()->routeIs('orders.*') ? 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-file-invoice mr-3"></i> Order Servis
                    </a>
                </nav>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex flex-col flex-1 lg:pl-72 w-full min-w-0">
            <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-200/60 h-20 flex items-center justify-between px-8">
                <h2 class="text-xs font-black text-slate-400 uppercase tracking-[0.3em]">
                    @isset($header) {{ $header }} @else Overview Dashboard @endisset
                </h2>
                @include('layouts.navigation')
            </header>

            {{-- REVISI DISINI: Overflow hidden di main agar table bisa scroll di dalam --}}
            <main class="py-10 px-4 md:px-8 w-full overflow-hidden">
                <div class="max-w-[1400px] mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>