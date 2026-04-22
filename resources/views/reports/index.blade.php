@extends('layouts.app')
@section('title', 'Laporan Penjualan')

@section('content')
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('reports.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Dari Tanggal</label>
                <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Sampai Tanggal</label>
                <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm mb-3">
    <div class="card-body d-flex justify-content-between align-items-center">
        <div>
            <div class="text-muted small">Total Pendapatan</div>
            <div class="fs-4 fw-bold text-success">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
        </div>
        <div class="text-muted">{{ $transactions->count() }} transaksi</div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <table class="table table-hover">
            <thead><tr><th>#</th><th>Invoice</th><th>Kasir</th><th>Total</th><th>Tanggal</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($transactions as $i => $trx)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><code>{{ $trx->invoice_number }}</code></td>
                    <td>{{ $trx->user->name }}</td>
                    <td>Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</td>
                    <td>{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                    <td><a href="{{ route('transactions.show', $trx) }}" class="btn btn-sm btn-info text-white"><i class="bi bi-eye"></i></a></td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted">Tidak ada transaksi pada periode ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
