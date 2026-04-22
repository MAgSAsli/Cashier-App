<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk - {{ $transaction->invoice_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: monospace; font-size: 12px; width: 300px; margin: 0 auto; padding: 10px; }
        .center { text-align: center; }
        .divider { border-top: 1px dashed #000; margin: 8px 0; }
        .row { display: flex; justify-content: space-between; }
        .bold { font-weight: bold; }
        @media print {
            .no-print { display: none; }
            body { width: 100%; }
        }
    </style>
</head>
<body>
    <div class="center bold" style="font-size:14px">CASHIER-LEARN</div>
    <div class="center">Struk Pembelian</div>
    <div class="divider"></div>
    <div class="row"><span>Invoice</span><span>{{ $transaction->invoice_number }}</span></div>
    <div class="row"><span>Kasir</span><span>{{ $transaction->user->name }}</span></div>
    <div class="row"><span>Tanggal</span><span>{{ $transaction->created_at->format('d/m/Y H:i') }}</span></div>
    <div class="divider"></div>

    @foreach($transaction->details as $detail)
    <div>{{ $detail->product->name }}</div>
    <div class="row">
        <span>{{ $detail->quantity }} x Rp {{ number_format($detail->price, 0, ',', '.') }}</span>
        <span>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
    </div>
    @endforeach

    <div class="divider"></div>
    <div class="row bold"><span>TOTAL</span><span>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span></div>
    <div class="row"><span>Bayar</span><span>Rp {{ number_format($transaction->paid_amount, 0, ',', '.') }}</span></div>
    <div class="row"><span>Kembalian</span><span>Rp {{ number_format($transaction->change_amount, 0, ',', '.') }}</span></div>
    <div class="divider"></div>
    <div class="center">Terima kasih!</div>

    <div class="no-print" style="margin-top:20px; text-align:center">
        <button onclick="window.print()" style="padding:8px 20px; cursor:pointer">🖨️ Print Struk</button>
        <a href="{{ route('transactions.index') }}" style="display:block; margin-top:8px">← Kembali</a>
    </div>

    <script>window.onload = () => window.print();</script>
</body>
</html>
