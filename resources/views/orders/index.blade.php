@extends(auth()->check() ? auth()->user()->panelLayout() : 'layouts.guest')
@section('title', 'Đơn hàng của tôi')
@section('content')
<h3>Đơn hàng của tôi</h3>
<table class="table bg-white">
    <thead><tr><th>Mã đơn</th><th>Tổng tiền</th><th>Trạng thái</th><th>Ngày đặt</th><th></th></tr></thead>
    <tbody>
        @forelse ($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ number_format($order->total_price) }}₫</td>
                <td><span class="badge bg-info">{{ $order->status }}</span></td>
                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                <td><a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary">Xem</a></td>
            </tr>
        @empty
            <tr><td colspan="5">Chưa có đơn hàng nào.</td></tr>
        @endforelse
    </tbody>
</table>
{{ $orders->links() }}
@endsection
