@extends('layouts.admin')
@section('title', 'Chi tiết đơn hàng')
@section('content')
<div class="row">
    <div class="col-md-7">
        <h3>Đơn hàng #{{ $order->id }}</h3>
        <p>Khách hàng: {{ $order->user->name }} ({{ $order->user->email }})</p>
        <p>Địa chỉ giao hàng: {{ $order->shipping_address }}</p>
        <p>Điện thoại: {{ $order->phone }}</p>

        <table class="table bg-white">
            <thead><tr><th>Sản phẩm</th><th>Đơn giá</th><th>SL</th><th>Thành tiền</th></tr></thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                        <td>{{ number_format($item->price) }}₫</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price * $item->quantity) }}₫</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h5>Tổng cộng: {{ number_format($order->total_price) }}₫</h5>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-body">
                <h5>Cập nhật trạng thái</h5>
                <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                    @csrf @method('PUT')
                    <select name="status" class="form-select mb-3">
                        @foreach (['pending','confirmed','shipping','completed','cancelled'] as $s)
                            <option value="{{ $s }}" @selected($order->status==$s)>{{ $s }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary w-100">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
