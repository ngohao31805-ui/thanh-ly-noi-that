<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Khách hàng') — Thu Mua Nội Thất</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background:#f1f3f6; }
        .panel-sidebar {
            width: 240px; min-height: 100vh; background: #1e2530;
            position: fixed; top: 0; left: 0; bottom: 0; padding-top: 1rem;
        }
        .panel-sidebar .brand { color:#fff; font-weight:700; font-size:1.1rem; padding:.5rem 1.25rem 1.5rem; display:block; text-decoration:none; }
        .panel-sidebar .nav-link { color:#b7c0cf; padding:.65rem 1.25rem; border-radius:0; display:flex; align-items:center; gap:.6rem; }
        .panel-sidebar .nav-link:hover { background:#29323f; color:#fff; }
        .panel-sidebar .nav-link.active { background:#0d6efd; color:#fff; }
        .panel-content { margin-left:240px; padding:1.75rem; }
        .panel-topbar { margin-left:240px; background:#fff; border-bottom:1px solid #e3e6eb; padding:.75rem 1.75rem; display:flex; justify-content:space-between; align-items:center; }
        @media (max-width: 768px) {
            .panel-sidebar { width:100%; min-height:auto; position:relative; }
            .panel-content, .panel-topbar { margin-left:0; }
        }
    </style>
</head>
<body>
    <div class="panel-sidebar">
        <a href="{{ route('products.index') }}" class="brand">🛋️ Khách hàng</a>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link @if(request()->routeIs('products.*')) active @endif">🛍️ Sản phẩm</a></li>
            <li class="nav-item"><a href="{{ route('cart.index') }}" class="nav-link @if(request()->routeIs('cart.*')) active @endif">🛒 Giỏ hàng</a></li>
            <li class="nav-item"><a href="{{ route('orders.index') }}" class="nav-link @if(request()->routeIs('orders.*')) active @endif">🧾 Đơn hàng của tôi</a></li>
            <li><hr class="text-secondary mx-3"></li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="nav-link border-0 bg-transparent w-100 text-start">🚪 Đăng xuất</button>
                </form>
            </li>
        </ul>
    </div>

    <div class="panel-topbar flex-wrap gap-2">
        <h5 class="mb-0">@yield('title', 'Khách hàng')</h5>
        <form action="{{ route('products.index') }}" method="GET" class="d-flex" style="width:280px">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Tìm sản phẩm..." value="{{ request('search') }}">
            <button class="btn btn-sm btn-outline-secondary ms-1">🔍</button>
        </form>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary">🏠 Trang chủ</a>
            <a href="{{ route('cart.index') }}" class="btn btn-sm btn-outline-secondary">🛒 Giỏ hàng</a>
            <span class="text-muted">Xin chào, <strong>{{ auth()->user()->name }}</strong></span>
        </div>
    </div>

    <div class="panel-content">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
