@extends(auth()->check() ? auth()->user()->panelLayout() : 'layouts.guest')
@section('title', 'Chi tiết đơn hàng')
@section('content')
<h3>Đơn hàng #{{ $order->id }}</h3>
<p>Trạng thái: <span class="badge bg-info">{{ $order->status }}</span></p>
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
@endsection
