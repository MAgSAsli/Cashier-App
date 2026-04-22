<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier-Learn | @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background-color: #212529; width: 250px; position: fixed; top: 0; left: 0; z-index: 100; }
        .sidebar .nav-link { color: #adb5bd; padding: 10px 20px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background-color: #343a40; }
        .sidebar .nav-link i { margin-right: 8px; }
        .sidebar-brand { padding: 20px; color: #fff; font-size: 1.2rem; font-weight: bold; border-bottom: 1px solid #343a40; }
        .main-content { margin-left: 250px; padding: 20px; }
        .topbar { background: #fff; padding: 12px 20px; border-bottom: 1px solid #dee2e6; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="sidebar d-flex flex-column">
        <div class="sidebar-brand"><i class="bi bi-cash-register"></i> Cashier-Learn</div>
        <nav class="nav flex-column mt-2">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('transactions.create') }}" class="nav-link {{ request()->routeIs('transactions.create') ? 'active' : '' }}">
                <i class="bi bi-cart-plus"></i> Transaksi Baru
            </a>
            <a href="{{ route('transactions.index') }}" class="nav-link {{ request()->routeIs('transactions.index') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i> Riwayat Transaksi
            </a>
            @if(auth()->user()->isAdmin())
            <hr class="border-secondary mx-3">
            <small class="text-muted px-3 mb-1">ADMIN</small>
            <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Produk
            </a>
            <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Kategori
            </a>
            <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Manajemen User
            </a>
            <a href="{{ route('reports.index') }}" class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                <i class="bi bi-bar-chart"></i> Laporan
            </a>
            @endif
        </nav>
        <div class="mt-auto p-3">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-danger btn-sm w-100"><i class="bi bi-box-arrow-left"></i> Logout</button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="topbar d-flex justify-content-between align-items-center rounded">
            <h6 class="mb-0">@yield('title', 'Dashboard')</h6>
            <span class="text-muted small"><i class="bi bi-person-circle"></i> {{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})</span>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
