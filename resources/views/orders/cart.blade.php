@extends(auth()->check() ? auth()->user()->panelLayout() : 'layouts.guest')
@section('title', 'Giỏ hàng')
@section('content')
<h3>Giỏ hàng của bạn</h3>

@if ($products->isEmpty())
    <p>Giỏ hàng trống. <a href="{{ route('products.index') }}">Tiếp tục mua sắm</a></p>
@else
    <table class="table bg-white">
        <thead>
            <tr><th>Sản phẩm</th><th>Đơn giá</th><th>Số lượng</th><th>Thành tiền</th><th></th></tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($products as $product)
                @php $subtotal = $product->price * $cart[$product->id]; $total += $subtotal; @endphp
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price) }}₫</td>
                    <td>{{ $cart[$product->id] }}</td>
                    <td>{{ number_format($subtotal) }}₫</td>
                    <td>
                        <form method="POST" action="{{ route('cart.remove', $product) }}">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h5>Tổng cộng: <span class="text-danger">{{ number_format($total) }}₫</span></h5>

    <form method="POST" action="{{ route('checkout') }}" class="card p-3 mt-3">
        @csrf
        <h5>Thông tin giao hàng</h5>
        <div class="mb-3">
            <label class="form-label">Địa chỉ giao hàng</label>
            <input type="text" name="shipping_address" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <button class="btn btn-success">Đặt hàng</button>
    </form>
@endif
@endsection
