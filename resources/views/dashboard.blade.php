@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-primary bg-opacity-10 p-3 rounded"><i class="bi bi-box-seam fs-4 text-primary"></i></div>
                <div>
                    <div class="text-muted small">Total Produk</div>
                    <div class="fs-4 fw-bold">{{ $totalProducts }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-success bg-opacity-10 p-3 rounded"><i class="bi bi-receipt fs-4 text-success"></i></div>
                <div>
                    <div class="text-muted small">Total Transaksi</div>
                    <div class="fs-4 fw-bold">{{ $totalTransactions }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-warning bg-opacity-10 p-3 rounded"><i class="bi bi-cash-stack fs-4 text-warning"></i></div>
                <div>
                    <div class="text-muted small">Total Pendapatan</div>
                    <div class="fs-4 fw-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-danger bg-opacity-10 p-3 rounded"><i class="bi bi-exclamation-triangle fs-4 text-danger"></i></div>
                <div>
                    <div class="text-muted small">Stok Menipis</div>
                    <div class="fs-4 fw-bold">{{ $lowStock }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body text-center py-5">
        <i class="bi bi-cart-plus fs-1 text-primary"></i>
        <h5 class="mt-3">Mulai Transaksi</h5>
        <p class="text-muted">Klik tombol di bawah untuk memulai transaksi baru</p>
        <a href="{{ route('transactions.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Transaksi Baru</a>
    </div>
</div>
@endsection
