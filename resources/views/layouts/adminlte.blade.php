<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIMB')</title>

    {{-- AdminLTE & FontAwesome --}}
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    
    <style>
        /* 1. Warna Dasar Sidebar Navy Gelap */
        .main-sidebar {
            background-color: #0f172a !important; 
            border-right: none !important;
        }

        /* 2. Style Menu Aktif Kotak Biru Indigo Melengkung */
        .nav-pills .nav-link.active {
            background-color: #5a57e6 !important; 
            color: #ffffff !important;
            border-radius: 12px !important;
            margin: 0 12px 5px 12px !important;
            padding: 10px 15px !important;
            box-shadow: 0 4px 15px rgba(90, 87, 230, 0.3) !important;
        }

        /* 3. Style Menu Tidak Aktif */
        .nav-sidebar .nav-item .nav-link {
            color: #94a3b8 !important;
            margin: 0 12px 5px 12px !important;
            transition: all 0.2s;
        }

        .nav-sidebar .nav-item .nav-link:hover {
            color: #ffffff !important;
            background-color: rgba(255,255,255,0.05) !important;
            border-radius: 12px;
        }

        /* 4. Logo Brand */
        .brand-link {
            padding: 25px 20px !important;
            border-bottom: none !important;
            text-align: center;
        }
        .brand-text {
            font-weight: 800 !important;
            color: #ffffff !important;
            font-size: 1.3rem;
            letter-spacing: 1px;
        }

        /* 5. Footer Sidebar 'Logged in as' */
        .sidebar-footer {
            position: absolute;
            bottom: 20px;
            left: 15px;
            right: 15px;
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 15px;
            padding: 15px;
        }

        /* 6. Hilangkan Semua Gaya Tulisan Miring (Italic) */
        * { font-style: normal !important; }
        .nav-header {
            color: #475569 !important;
            font-size: 0.7rem !important;
            font-weight: 800 !important;
            padding: 20px 25px 10px 25px !important;
        }

        /* Content Area Rapi */
        .content-wrapper { background-color: #ffffff !important; }
    </style>
    @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('partials.navbar')

    <aside class="main-sidebar sidebar-dark-primary elevation-0">
        <div class="brand-link">
            <span class="brand-text">SIM<span style="color: #6366f1;">BENGKEL</span></span>
        </div>

        <div class="sidebar">
            <nav class="mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th-large mr-2"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-header text-uppercase">Master Data</li>
                    <li class="nav-item">
                        <a href="{{ route('services.index') }}" class="nav-link {{ request()->is('services*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tools mr-2"></i>
                            <p>Layanan Servis</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customers.index') }}" class="nav-link {{ request()->is('customers*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users mr-2"></i>
                            <p>Pelanggan</p>
                        </a>
                    </li>

                    <li class="nav-header text-uppercase">Transaksi</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice mr-2"></i>
                            <p>Order Servis</p>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="sidebar-footer">
                <p class="text-uppercase text-muted mb-0" style="font-size: 0.6rem; font-weight: 700;">Logged in as</p>
                <p class="text-white font-weight-bold mb-0" style="font-size: 0.9rem;">CSW</p>
            </div>
        </div>
    </aside>

    <div class="content-wrapper">
        <section class="content pt-4">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>
</div>

<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
@stack('scripts')
</body>
</html>