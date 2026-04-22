@extends('layouts.app')
@section('title', 'Produk')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Daftar Produk</h6>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Tambah</a>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead><tr><th>#</th><th>Kode</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><code>{{ $product->code }}</code></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge {{ $product->stock < 10 ? 'bg-danger' : 'bg-success' }}">{{ $product->stock }}</span>
                    </td>
                    <td>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus produk ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted">Belum ada produk.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
</div>
@endsection
