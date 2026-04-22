@extends('layouts.app')
@section('title', 'Kategori')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Daftar Kategori</h6>
        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Tambah</a>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead><tr><th>#</th><th>Nama</th><th>Jumlah Produk</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->products_count }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted">Belum ada kategori.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
</div>
@endsection
