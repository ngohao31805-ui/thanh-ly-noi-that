@extends('layouts.seller')
@section('title', 'Khu vực người bán')
@section('content')
<h3>Xin chào, {{ auth()->user()->name }} 👋</h3>
<a href="{{ route('seller.requests.create') }}" class="btn btn-primary mb-4">+ Gửi yêu cầu bán / thanh lý nội thất</a>

<div class="row">
    <div class="col-md-6">
        <h5>Yêu cầu gần đây của bạn</h5>
        <table class="table bg-white">
            <thead><tr><th>Tiêu đề</th><th>Giá đề xuất</th><th>Trạng thái</th></tr></thead>
            <tbody>
                @forelse ($myRequests as $r)
                    <tr>
                        <td><a href="{{ route('seller.requests.show', $r) }}">{{ $r->title }}</a></td>
                        <td>{{ $r->expected_price ? number_format($r->expected_price).'₫' : '-' }}</td>
                        <td><span class="badge bg-secondary">{{ $r->status }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="3">Chưa có yêu cầu nào.</td></tr>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('seller.requests.index') }}">Xem tất cả yêu cầu →</a>
    </div>
    <div class="col-md-6">
        <h5>Đơn hàng gần đây</h5>
        <table class="table bg-white">
            <thead><tr><th>Mã đơn</th><th>Tổng tiền</th><th>Trạng thái</th></tr></thead>
            <tbody>
                @forelse ($myOrders as $o)
                    <tr>
                        <td><a href="{{ route('orders.show', $o) }}">#{{ $o->id }}</a></td>
                        <td>{{ number_format($o->total_price) }}₫</td>
                        <td><span class="badge bg-info">{{ $o->status }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="3">Chưa có đơn hàng nào.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
