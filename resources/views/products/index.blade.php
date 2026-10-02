@extends(auth()->check() ? auth()->user()->panelLayout() : 'layouts.guest')
@section('title', 'Sản phẩm nội thất')
@section('content')
<h3 class="mb-4">Nội thất đã thu mua & sẵn sàng bán lại</h3>

<div class="row g-4">
    {{-- Bộ lọc --}}
    <div class="col-md-3">
        <form method="GET" class="card p-3 shadow-sm">
            <h6 class="mb-3">Bộ lọc tìm kiếm</h6>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Từ khóa</label>
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Tìm kiếm..." value="{{ request('search') }}">
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Loại nội thất</label>
                <select name="category_id" class="form-select form-select-sm">
                    <option value="">Tất cả danh mục</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Khoảng giá (₫)</label>
                <div class="d-flex gap-2">
                    <input type="number" name="price_min" class="form-control form-control-sm" placeholder="Từ" value="{{ request('price_min') }}">
                    <input type="number" name="price_max" class="form-control form-control-sm" placeholder="Đến" value="{{ request('price_max') }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Chiều dài (cm)</label>
                <div class="d-flex gap-2">
                    <input type="number" name="length_min" class="form-control form-control-sm" placeholder="Từ" value="{{ request('length_min') }}">
                    <input type="number" name="length_max" class="form-control form-control-sm" placeholder="Đến" value="{{ request('length_max') }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Chiều rộng (cm)</label>
                <div class="d-flex gap-2">
                    <input type="number" name="width_min" class="form-control form-control-sm" placeholder="Từ" value="{{ request('width_min') }}">
                    <input type="number" name="width_max" class="form-control form-control-sm" placeholder="Đến" value="{{ request('width_max') }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Kích thước (chiều cao, cm)</label>
                <div class="d-flex gap-2">
                    <input type="number" name="height_min" class="form-control form-control-sm" placeholder="Từ" value="{{ request('height_min') }}">
                    <input type="number" name="height_max" class="form-control form-control-sm" placeholder="Đến" value="{{ request('height_max') }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Tình trạng</label>
                <select name="condition" class="form-select form-select-sm">
                    <option value="">Tất cả</option>
                    @foreach ($conditions as $key => $label)
                        <option value="{{ $key }}" @selected(request('condition') == $key)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Thương hiệu</label>
                <select name="brand" class="form-select form-select-sm">
                    <option value="">Tất cả</option>
                    @foreach ($brands as $b)
                        <option value="{{ $b }}" @selected(request('brand') == $b)>{{ $b }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Nơi bán</label>
                <select name="location" class="form-select form-select-sm">
                    <option value="">Tất cả</option>
                    @foreach ($locations as $loc)
                        <option value="{{ $loc }}" @selected(request('location') == $loc)>{{ $loc }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Đơn vị vận chuyển</label>
                <select name="shipping_unit" class="form-select form-select-sm">
                    <option value="">Tất cả</option>
                    @foreach ($shippingUnits as $s)
                        <option value="{{ $s }}" @selected(request('shipping_unit') == $s)>{{ $s }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary btn-sm">Lọc</button>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm mt-2">Xóa bộ lọc</a>
        </form>
    </div>

    {{-- Danh sách sản phẩm --}}
    <div class="col-md-9">
        <div class="row g-4">
            @forelse ($products as $product)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        @if ($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" style="height:180px;object-fit:cover">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height:180px;font-size:2.5rem">🛋️</div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="text-muted small mb-1">{{ $product->category->name ?? 'Chưa phân loại' }}</p>
                            <p class="text-muted small mb-1">
                                @if ($product->brand) {{ $product->brand }} &middot; @endif
                                {{ $product->conditionLabel() }}
                            </p>
                            @if ($product->length_cm || $product->width_cm || $product->height_cm)
                                <p class="text-muted small mb-1">
                                    Kích thước: {{ $product->length_cm ?? '?' }} x {{ $product->width_cm ?? '?' }} x {{ $product->height_cm ?? '?' }} cm
                                </p>
                            @endif
                            @if ($product->location)
                                <p class="text-muted small mb-1">📍 {{ $product->location }}</p>
                            @endif
                            <p class="fw-bold text-danger">{{ number_format($product->price) }}₫</p>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>Không tìm thấy sản phẩm phù hợp với bộ lọc.</p>
            @endforelse
        </div>

        <div class="mt-4">{{ $products->links() }}</div>
    </div>
</div>
@endsection
