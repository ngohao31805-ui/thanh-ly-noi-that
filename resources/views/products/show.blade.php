@extends(auth()->check() ? auth()->user()->panelLayout() : 'layouts.guest')
@section('title', $product->name)
@section('content')
<div class="row">
    <div class="col-md-5">
        @if ($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid rounded shadow-sm">
        @else
            <div class="bg-light d-flex align-items-center justify-content-center text-muted rounded" style="height:280px;font-size:3rem">🛋️</div>
        @endif
    </div>
    <div class="col-md-7">
        <h3>{{ $product->name }}</h3>
        <p class="text-muted">{{ $product->category->name ?? 'Chưa phân loại' }}</p>
        <p>{{ $product->description }}</p>

        <table class="table table-sm w-auto">
            <tbody>
                @if ($product->brand)
                    <tr><th class="text-muted">Thương hiệu</th><td>{{ $product->brand }}</td></tr>
                @endif
                <tr><th class="text-muted">Tình trạng</th><td>{{ $product->conditionLabel() }}</td></tr>
                @if ($product->length_cm || $product->width_cm || $product->height_cm)
                    <tr><th class="text-muted">Kích thước (D x R x C)</th><td>{{ $product->length_cm ?? '?' }} x {{ $product->width_cm ?? '?' }} x {{ $product->height_cm ?? '?' }} cm</td></tr>
                @endif
                @if ($product->location)
                    <tr><th class="text-muted">Nơi bán</th><td>{{ $product->location }}</td></tr>
                @endif
                @if ($product->shipping_unit)
                    <tr><th class="text-muted">Đơn vị vận chuyển</th><td>{{ $product->shipping_unit }}</td></tr>
                @endif
            </tbody>
        </table>

        <h4 class="text-danger">{{ number_format($product->price) }}₫</h4>
        <p>Còn lại: {{ $product->quantity }} sản phẩm</p>

        @auth
            <form method="POST" action="{{ route('cart.add', $product) }}" class="d-flex gap-2">
                @csrf
                <input type="number" name="quantity" value="1" min="1" max="{{ $product->quantity }}" class="form-control" style="width: 100px">
                <button class="btn btn-primary" @disabled($product->status !== 'available')>Thêm vào giỏ</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">Đăng nhập để mua hàng</a>
        @endauth
    </div>
</div>
@endsection
