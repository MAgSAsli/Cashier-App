@extends('layouts.app')
@section('title', 'Transaksi Baru')

@section('content')
<div class="row g-4">
    <div class="col-md-7">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white"><h6 class="mb-0">Pilih Produk</h6></div>
            <div class="card-body">
                <input type="text" id="searchProduct" class="form-control mb-3" placeholder="Cari produk...">
                <div class="row g-2" id="productList">
                    @foreach($products as $product)
                    <div class="col-md-4 product-item" data-name="{{ strtolower($product->name) }}">
                        <div class="card border h-100 product-card" style="cursor:pointer"
                            data-id="{{ $product->id }}"
                            data-name="{{ $product->name }}"
                            data-price="{{ $product->price }}"
                            data-stock="{{ $product->stock }}">
                            <div class="card-body p-2 text-center">
                                <div class="fw-bold small">{{ $product->name }}</div>
                                <div class="text-primary small">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                <div class="text-muted" style="font-size:11px">Stok: {{ $product->stock }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white"><h6 class="mb-0">Keranjang</h6></div>
            <div class="card-body">
                <form action="{{ route('transactions.store') }}" method="POST" id="transactionForm">
                    @csrf
                    <div id="cartItems">
                        <p class="text-muted text-center" id="emptyCart">Keranjang kosong</p>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold mb-3">
                        <span>Total</span>
                        <span id="totalDisplay">Rp 0</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Uang Bayar</label>
                        <input type="number" name="paid_amount" id="paidAmount" class="form-control" min="0" required>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Kembalian</span>
                        <span id="changeDisplay" class="fw-bold text-success">Rp 0</span>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" id="btnCheckout" disabled>
                        <i class="bi bi-check-circle"></i> Proses Transaksi
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let cart = {};
    let total = 0;

    document.querySelectorAll('.product-card').forEach(card => {
        card.addEventListener('click', () => {
            const id = card.dataset.id;
            const name = card.dataset.name;
            const price = parseFloat(card.dataset.price);
            const stock = parseInt(card.dataset.stock);

            if (cart[id]) {
                if (cart[id].qty >= stock) return alert('Stok tidak cukup!');
                cart[id].qty++;
            } else {
                cart[id] = { name, price, qty: 1, stock };
            }
            renderCart();
        });
    });

    document.getElementById('searchProduct').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.product-item').forEach(item => {
            item.style.display = item.dataset.name.includes(q) ? '' : 'none';
        });
    });

    document.getElementById('paidAmount').addEventListener('input', updateChange);

    function renderCart() {
        const container = document.getElementById('cartItems');
        const empty = document.getElementById('emptyCart');
        const form = document.getElementById('transactionForm');

        // Remove old hidden inputs
        form.querySelectorAll('.cart-input').forEach(el => el.remove());

        total = 0;
        let html = '';
        let i = 0;

        for (const id in cart) {
            const item = cart[id];
            total += item.price * item.qty;
            html += `
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <div class="small fw-bold">${item.name}</div>
                        <div class="text-muted" style="font-size:12px">Rp ${formatRp(item.price)} x ${item.qty}</div>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="changeQty('${id}', -1)">-</button>
                        <span>${item.qty}</span>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="changeQty('${id}', 1)">+</button>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeItem('${id}')"><i class="bi bi-x"></i></button>
                    </div>
                </div>`;

            const hiddenId = document.createElement('input');
            hiddenId.type = 'hidden';
            hiddenId.name = `products[${i}][id]`;
            hiddenId.value = id;
            hiddenId.className = 'cart-input';
            form.appendChild(hiddenId);

            const hiddenQty = document.createElement('input');
            hiddenQty.type = 'hidden';
            hiddenQty.name = `products[${i}][qty]`;
            hiddenQty.value = item.qty;
            hiddenQty.className = 'cart-input';
            form.appendChild(hiddenQty);

            i++;
        }

        container.innerHTML = Object.keys(cart).length ? html : '<p class="text-muted text-center">Keranjang kosong</p>';
        document.getElementById('totalDisplay').textContent = 'Rp ' + formatRp(total);
        document.getElementById('btnCheckout').disabled = Object.keys(cart).length === 0;
        updateChange();
    }

    function changeQty(id, delta) {
        cart[id].qty += delta;
        if (cart[id].qty <= 0) delete cart[id];
        else if (cart[id].qty > cart[id].stock) { cart[id].qty = cart[id].stock; alert('Stok tidak cukup!'); }
        renderCart();
    }

    function removeItem(id) { delete cart[id]; renderCart(); }

    function updateChange() {
        const paid = parseFloat(document.getElementById('paidAmount').value) || 0;
        const change = paid - total;
        document.getElementById('changeDisplay').textContent = 'Rp ' + formatRp(change < 0 ? 0 : change);
    }

    function formatRp(n) { return n.toLocaleString('id-ID'); }
</script>
@endpush
