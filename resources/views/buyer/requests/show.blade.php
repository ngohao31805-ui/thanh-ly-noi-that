@extends('layouts.buyer')
@section('title', 'Xử lý yêu cầu')
@section('content')
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <h4>{{ $purchaseRequest->title }}</h4>
                <p class="text-muted">Người bán: {{ $purchaseRequest->seller->name }} — {{ $purchaseRequest->seller->phone }}</p>
                @if ($purchaseRequest->image)
                    <img src="{{ asset('storage/'.$purchaseRequest->image) }}" class="img-fluid mb-3" style="max-width:300px">
                @endif
                <p>{{ $purchaseRequest->description }}</p>
                <p>Danh mục: {{ $purchaseRequest->category->name ?? '-' }}</p>
                <p>Giá mong muốn: <strong>{{ $purchaseRequest->expected_price ? number_format($purchaseRequest->expected_price).'₫' : '-' }}</strong></p>
                <span class="badge bg-secondary">{{ $purchaseRequest->status }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        @if (in_array($purchaseRequest->status, ['pending', 'valuated']))
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Định giá thu mua</h5>
                    <form method="POST" action="{{ route('buyer.requests.valuate', $purchaseRequest) }}">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Giá đề xuất thu mua (VNĐ)</label>
                            <input type="number" name="offered_price" class="form-control" value="{{ $purchaseRequest->offered_price }}" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ghi chú</label>
                            <textarea name="buyer_note" class="form-control">{{ $purchaseRequest->buyer_note }}</textarea>
                        </div>
                        <button class="btn btn-warning w-100">Lưu định giá</button>
                    </form>
                </div>
            </div>
        @endif

        @if ($purchaseRequest->status === 'valuated')
            <form method="POST" action="{{ route('buyer.requests.approve', $purchaseRequest) }}" class="mb-2">
                @csrf @method('PUT')
                <button class="btn btn-primary w-100">✔ Chốt thu mua (đưa vào kho bán lại)</button>
            </form>
        @endif

        @if (!in_array($purchaseRequest->status, ['rejected', 'completed']))
            <form method="POST" action="{{ route('buyer.requests.reject', $purchaseRequest) }}">
                @csrf @method('PUT')
                <input type="text" name="buyer_note" class="form-control mb-2" placeholder="Lý do từ chối (tuỳ chọn)">
                <button class="btn btn-outline-danger w-100">✖ Từ chối yêu cầu</button>
            </form>
        @endif
    </div>
</div>
@endsection
