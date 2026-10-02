@extends('layouts.admin')
@section('title', 'Quản trị hệ thống')
@section('content')
<h3>Bảng điều khiển Quản trị</h3>

<div class="row g-3 mb-4">
    <div class="col-md-2">
        <div class="card text-bg-secondary"><div class="card-body"><h6>Khách hàng</h6><h3>{{ $stats['total_customers'] }}</h3></div></div>
    </div>
    <div class="col-md-2">
        <div class="card" style="background:#198754;color:#fff"><div class="card-body"><h6>Người bán</h6><h3>{{ $stats['total_sellers'] }}</h3></div></div>
    </div>
    <div class="col-md-2">
        <div class="card" style="background:#fd7e14;color:#fff"><div class="card-body"><h6>NV thu mua</h6><h3>{{ $stats['total_buyers'] }}</h3></div></div>
    </div>
    <div class="col-md-2">
        <div class="card text-bg-warning"><div class="card-body"><h6>Yêu cầu chờ</h6><h3>{{ $stats['pending_requests'] }}</h3></div></div>
    </div>
    <div class="col-md-2">
        <div class="card text-bg-primary"><div class="card-body"><h6>Sản phẩm</h6><h3>{{ $stats['total_products'] }}</h3></div></div>
    </div>
    <div class="col-md-2">
        <div class="card text-bg-dark"><div class="card-body"><h6>Đơn hàng</h6><h3>{{ $stats['total_orders'] }}</h3></div></div>
    </div>
</div>
<div class="row g-3 mb-4">
    <div class="col-md-2">
        <div class="card text-bg-success"><div class="card-body"><h6>Doanh thu</h6><h5>{{ number_format($stats['revenue']) }}₫</h5></div></div>
    </div>
</div>

<div class="d-flex gap-2 mb-4">
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Quản lý tài khoản</a>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Danh mục</a>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Kho sản phẩm</a>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">Đơn hàng</a>
</div>

<div class="row">
    <div class="col-md-6">
        <h5>Đơn hàng gần đây</h5>
        <table class="table bg-white">
            <thead><tr><th>Mã</th><th>Khách</th><th>Tổng</th><th>Trạng thái</th><th></th></tr></thead>
            <tbody>
                @forelse ($recentOrders as $o)
                    <tr>
                        <td>#{{ $o->id }}</td>
                        <td>{{ $o->user->name }}</td>
                        <td>{{ number_format($o->total_price) }}₫</td>
                        <td><span class="badge bg-info">{{ $o->status }}</span></td>
                        <td><a href="{{ route('admin.orders.show', $o) }}" class="btn btn-sm btn-outline-primary">Xử lý</a></td>
                    </tr>
                @empty
                    <tr><td colspan="5">Chưa có đơn hàng.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <h5>Yêu cầu thu mua gần đây</h5>
        <table class="table bg-white">
            <thead><tr><th>Người bán</th><th>NV thu mua</th><th>Trạng thái</th></tr></thead>
            <tbody>
                @forelse ($recentRequests as $r)
                    <tr><td>{{ $r->seller->name }}</td><td>{{ $r->buyer->name ?? '-' }}</td><td>{{ $r->status }}</td></tr>
                @empty
                    <tr><td colspan="3">Chưa có yêu cầu.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
