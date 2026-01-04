<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SIMB') }} | Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-transition { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-full antialiased text-slate-900 overflow-x-hidden" x-data="{ sidebarOpen: true }" x-cloak>
    <div class="min-h-screen flex relative">
        
        {{-- Sidebar --}}
        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="sidebar-transition fixed inset-y-0 left-0 w-72 bg-slate-900 shadow-2xl z-50 flex flex-col">
            
            <div class="flex flex-col flex-grow pt-8 overflow-y-auto">
                <div class="flex items-center justify-between px-8 mb-10">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-indigo-500 rounded-lg mr-3 shadow-lg shadow-indigo-500/50"></div>
                        <span class="text-xl font-black text-white tracking-tighter italic">SIM<span class="text-indigo-400 font-light">BENGKEL</span></span>
                    </div>
                </div>
                
                <nav class="flex-1 px-4 space-y-1">
                    {{-- Nav Link Dashboard --}}
                    <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3.5 text-sm font-bold rounded-2xl transition-all {{ request()->routeIs('dashboard') ? 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                    </a>

                    {{-- MENU KHUSUS ADMIN --}}
                    @if(Auth::user()->role == 'admin')
                        <div class="pt-6 pb-2 px-6 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Master Data</div>
                        <a href="{{ route('services.index') }}" class="flex items-center px-6 py-3.5 text-sm font-bold rounded-2xl transition-all {{ request()->routeIs('services.*') ? 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <i class="fas fa-wrench mr-3"></i> Layanan Servis
                        </a>
                        <a href="{{ route('customers.index') }}" class="flex items-center px-6 py-3.5 text-sm font-bold rounded-2xl transition-all {{ request()->routeIs('customers.*') ? 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <i class="fas fa-users mr-3"></i> Pelanggan
                        </a>
                        
                        <div class="pt-6 pb-2 px-6 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Transaksi</div>
                        <a href="{{ route('orders.index') }}" class="flex items-center px-6 py-3.5 text-sm font-bold rounded-2xl transition-all {{ request()->routeIs('orders.index') ? 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <i class="fas fa-file-invoice mr-3"></i> Validasi Order
                        </a>
                    @endif

                    {{-- MENU KHUSUS CUSTOMER --}}
                    @if(Auth::user()->role == 'customer')
                        <div class="pt-6 pb-2 px-6 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Garasiku</div>
                        <a href="{{ route('vehicles.index') }}" class="flex items-center px-6 py-3.5 text-sm font-bold rounded-2xl transition-all {{ request()->routeIs('vehicles.*') ? 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <i class="fas fa-motorcycle mr-3"></i> Motor Saya
                        </a>

                        <div class="pt-6 pb-2 px-6 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Aktivitas</div>
                        <a href="{{ route('orders.create') }}" class="flex items-center px-6 py-3.5 text-sm font-bold rounded-2xl transition-all {{ request()->routeIs('orders.create') ? 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <i class="fas fa-tools mr-3"></i> Booking Servis
                        </a>
                        <a href="{{ route('riwayat.index') }}" class="flex items-center px-6 py-3.5 text-sm font-bold rounded-2xl transition-all {{ request()->routeIs('riwayat.index') ? 'text-white bg-indigo-600 shadow-lg shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <i class="fas fa-history mr-3"></i> Riwayat Servis
                        </a>
                    @endif
                </nav>

                {{-- User Info & Logout --}}
                <div class="p-4 border-t border-slate-800 bg-slate-900/50">
                    <div class="flex items-center px-4 py-3 mb-2">
                        <div class="w-10 h-10 rounded-full bg-indigo-500/20 flex items-center justify-center text-indigo-400 font-black italic mr-3 border border-indigo-500/30">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="flex flex-col overflow-hidden">
                            <span class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</span>
                            <span class="text-[10px] font-medium text-slate-500 uppercase tracking-widest">{{ Auth::user()->role }}</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-6 py-3 text-sm font-bold text-rose-400 hover:bg-rose-500/10 rounded-2xl transition-all group border border-transparent hover:border-rose-500/20">
                            <i class="fas fa-sign-out-alt mr-3 group-hover:translate-x-1 transition-transform"></i> Keluar Akun
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Main Content --}}
        <div 
            :class="sidebarOpen ? 'lg:pl-72' : 'lg:pl-0'"
            class="sidebar-transition flex flex-col flex-1 w-full min-w-0">
            
            <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-200/60 h-20 flex items-center justify-between px-8">
                <div class="flex items-center gap-6">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-slate-600 hover:text-indigo-600 transition-colors p-2 bg-slate-50 rounded-xl border border-slate-200">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                    
                    <h2 class="text-xs font-black text-slate-400 uppercase tracking-[0.3em]">
                        {{ $header ?? 'Overview Dashboard' }}
                    </h2>
                </div>

                <div class="flex items-center gap-4">
                    <span class="hidden md:block text-[10px] font-black text-slate-400 uppercase tracking-widest bg-slate-50 px-4 py-2 rounded-full border border-slate-100 italic">
                        <i class="far fa-calendar-alt mr-2"></i> {{ date('l, d M Y') }}
                    </span>
                </div>
            </header>

            <main class="py-10 px-4 md:px-8 w-full">
                <div class="max-w-[1400px] mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>