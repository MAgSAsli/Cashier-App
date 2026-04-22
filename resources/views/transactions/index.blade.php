@extends('layouts.app')
@section('title', 'Riwayat Transaksi')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white"><h6 class="mb-0">Riwayat Transaksi</h6></div>
    <div class="card-body">
        <table class="table table-hover">
            <thead><tr><th>#</th><th>Invoice</th><th>Kasir</th><th>Total</th><th>Tanggal</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($transactions as $trx)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><code>{{ $trx->invoice_number }}</code></td>
                    <td>{{ $trx->user->name }}</td>
                    <td>Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</td>
                    <td>{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('transactions.show', $trx) }}" class="btn btn-sm btn-info text-white"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('transactions.receipt', $trx) }}" class="btn btn-sm btn-secondary" target="_blank"><i class="bi bi-printer"></i></a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted">Belum ada transaksi.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $transactions->links() }}
    </div>
</div>
@endsection
