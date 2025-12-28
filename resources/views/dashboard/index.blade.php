@extends('layouts.adminlte')

@section('title', 'Dashboard')

@push('css')
<style>
    /* Menghilangkan semua gaya miring di dashboard */
    h3, p, span, a, .small-box .inner {
        font-style: normal !important;
        font-family: 'Source Sans Pro', sans-serif;
    }
    /* Memperbesar angka agar lebih tegas */
    .small-box h3 {
        font-weight: 800 !important;
        font-size: 2.8rem !important;
    }
</style>
@endpush

{{-- @section('content_header') DIHAPUS AGAR TIDAK ADA TULISAN --}}

@section('content')
<div class="row">
    {{-- Box 1: Pelanggan --}}
    <div class="col-lg-3 col-6">
        <div class="small-box shadow-sm border-0" style="border-radius: 1.5rem; background-color: #ffffff;">
            <div class="inner p-4">
                <p class="text-uppercase font-weight-bold text-muted mb-1" style="font-size: 0.7rem; letter-spacing: 0.1em;">Total Pelanggan</p>
                <h3 class="text-dark mb-0">{{ $stats['total_customers'] }}</h3>
            </div>
            <div class="icon"><i class="fas fa-users text-primary opacity-25"></i></div>
            <a href="{{ route('customers.index') }}" class="small-box-footer bg-primary border-0" style="border-bottom-left-radius: 1.5rem; border-bottom-right-radius: 1.5rem;">Lihat Detail</a>
        </div>
    </div>

    {{-- Box 2: Layanan --}}
    <div class="col-lg-3 col-6">
        <div class="small-box shadow-sm border-0" style="border-radius: 1.5rem; background-color: #ffffff;">
            <div class="inner p-4">
                <p class="text-uppercase font-weight-bold text-muted mb-1" style="font-size: 0.7rem; letter-spacing: 0.1em;">Total Layanan</p>
                <h3 class="text-dark mb-0">{{ $stats['total_services'] ?? '2' }}</h3>
            </div>
            <div class="icon"><i class="fas fa-tools text-info opacity-25"></i></div>
            <a href="{{ route('services.index') }}" class="small-box-footer bg-info border-0" style="border-bottom-left-radius: 1.5rem; border-bottom-right-radius: 1.5rem;">Lihat Detail</a>
        </div>
    </div>

    {{-- Box 3: Pending --}}
    <div class="col-lg-3 col-6">
        <div class="small-box shadow-sm border-0" style="border-radius: 1.5rem; background-color: #ffffff;">
            <div class="inner p-4">
                <p class="text-uppercase font-weight-bold text-muted mb-1" style="font-size: 0.7rem; letter-spacing: 0.1em;">Order Pending</p>
                <h3 class="text-dark mb-0">{{ $stats['pending_orders'] }}</h3>
            </div>
            <div class="icon"><i class="fas fa-clock text-warning opacity-25"></i></div>
            <a href="{{ route('orders.index') }}" class="small-box-footer bg-warning border-0" style="border-bottom-left-radius: 1.5rem; border-bottom-right-radius: 1.5rem;">Lihat Detail</a>
        </div>
    </div>

    {{-- Box 4: Selesai --}}
    <div class="col-lg-3 col-6">
        <div class="small-box shadow-sm border-0" style="border-radius: 1.5rem; background-color: #ffffff;">
            <div class="inner p-4">
                <p class="text-uppercase font-weight-bold text-muted mb-1" style="font-size: 0.7rem; letter-spacing: 0.1em;">Order Selesai</p>
                <h3 class="text-dark mb-0">{{ $stats['done_orders'] }}</h3>
            </div>
            <div class="icon"><i class="fas fa-check-circle text-success opacity-25"></i></div>
            <a href="{{ route('orders.index') }}" class="small-box-footer bg-success border-0" style="border-bottom-left-radius: 1.5rem; border-bottom-right-radius: 1.5rem;">Lihat Detail</a>
        </div>
    </div>
</div>
@endsection