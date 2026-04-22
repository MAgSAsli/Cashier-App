@extends('layouts.app')
@section('title', 'Detail Transaksi')

@section('content')
<div class="card border-0 shadow-sm" style="max-width: 600px">
    <div class="card-header bg-white d-flex justify-content-between">
        <h6 class="mb-0">Detail Transaksi</h6>
        <a href="{{ route('transactions.receipt', $transaction) }}" class="btn btn-sm btn-secondary" target="_blank"><i class="bi bi-printer"></i> Cetak Struk</a>
    </div>
    <div class="card-body">
        <table class="table table-sm">
            <tr><td class="text-muted">Invoice</td><td><code>{{ $transaction->invoice_number }}</code></td></tr>
            <tr><td class="text-muted">Kasir</td><td>{{ $transaction->user->name }}</td></tr>
            <tr><td class="text-muted">Tanggal</td><td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td></tr>
        </table>
        <hr>
        <table class="table table-sm">
            <thead><tr><th>Produk</th><th>Qty</th><th>Harga</th><th>Subtotal</th></tr></thead>
            <tbody>
                @foreach($transaction->details as $detail)
                <tr>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <div class="d-flex justify-content-between"><span>Total</span><strong>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</strong></div>
        <div class="d-flex justify-content-between"><span>Bayar</span><span>Rp {{ number_format($transaction->paid_amount, 0, ',', '.') }}</span></div>
        <div class="d-flex justify-content-between"><span>Kembalian</span><span class="text-success">Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}</span></div>
    </div>
    <div class="card-footer bg-white">
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
</div>
@endsection
