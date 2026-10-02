@extends('layouts.seller')
@section('title', 'Chi tiết yêu cầu')
@section('content')
<div class="card">
    <div class="card-body">
        <h4>{{ $purchaseRequest->title }}</h4>
        <p class="text-muted">{{ $purchaseRequest->category->name ?? 'Chưa phân loại' }}</p>
        @if ($purchaseRequest->image)
            <img src="{{ asset('storage/'.$purchaseRequest->image) }}" class="img-fluid mb-3" style="max-width:300px">
        @endif
        <p>{{ $purchaseRequest->description }}</p>
        <p>Giá mong muốn: <strong>{{ $purchaseRequest->expected_price ? number_format($purchaseRequest->expected_price).'₫' : '-' }}</strong></p>
        <p>Giá thu mua đề xuất: <strong>{{ $purchaseRequest->offered_price ? number_format($purchaseRequest->offered_price).'₫' : 'Chưa định giá' }}</strong></p>
        @if ($purchaseRequest->buyer_note)
            <div class="alert alert-info">Ghi chú từ NV thu mua: {{ $purchaseRequest->buyer_note }}</div>
        @endif
        <span class="badge bg-secondary">{{ $purchaseRequest->status }}</span>
    </div>
</div>
@endsection
