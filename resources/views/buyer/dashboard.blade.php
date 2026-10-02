@extends('layouts.buyer')
@section('title', 'Bảng điều khiển Thu mua')
@section('content')
<h3>Bảng điều khiển Nhân viên thu mua</h3>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-bg-secondary"><div class="card-body">
            <h6>Chờ xử lý</h6><h3>{{ $stats['pending'] }}</h3>
        </div></div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-warning"><div class="card-body">
            <h6>Đã định giá</h6><h3>{{ $stats['valuated'] }}</h3>
        </div></div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-primary"><div class="card-body">
            <h6>Tôi đã chốt</h6><h3>{{ $stats['my_approved'] }}</h3>
        </div></div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-success"><div class="card-body">
            <h6>Tôi đã hoàn tất</h6><h3>{{ $stats['my_completed'] }}</h3>
        </div></div>
    </div>
</div>

<h5>Yêu cầu mới chờ xử lý</h5>
<table class="table bg-white">
    <thead><tr><th>Người bán</th><th>Tiêu đề</th><th>Giá mong muốn</th><th></th></tr></thead>
    <tbody>
        @forelse ($newRequests as $r)
            <tr>
                <td>{{ $r->seller->name }}</td>
                <td>{{ $r->title }}</td>
                <td>{{ $r->expected_price ? number_format($r->expected_price).'₫' : '-' }}</td>
                <td><a href="{{ route('buyer.requests.show', $r) }}" class="btn btn-sm btn-outline-primary">Xử lý</a></td>
            </tr>
        @empty
            <tr><td colspan="4">Không có yêu cầu mới.</td></tr>
        @endforelse
    </tbody>
</table>
<a href="{{ route('buyer.requests.index') }}">Xem tất cả yêu cầu →</a>
@endsection
