@extends('layouts.admin')
@section('title', 'Sửa sản phẩm')
@section('content')
<div class="card" style="max-width:700px">
    <div class="card-body">
        <h4>Sửa sản phẩm</h4>
        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3"><label class="form-label">Tên sản phẩm</label><input name="name" class="form-control" value="{{ $product->name }}" required></div>

            <div class="mb-3">
                <label class="form-label">Danh mục / Loại nội thất</label>
                <select name="category_id" class="form-select">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" @selected($product->category_id==$cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3"><label class="form-label">Mô tả</label><textarea name="description" class="form-control">{{ $product->description }}</textarea></div>

            <div class="mb-3">
                <label class="form-label">Hình ảnh sản phẩm</label>
                @if ($product->image)
                    <div class="mb-2"><img src="{{ asset('storage/'.$product->image) }}" style="max-width:150px" class="img-thumbnail"></div>
                @endif
                <input type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Để trống nếu không muốn đổi ảnh hiện tại.</small>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label">Giá bán (VNĐ)</label><input type="number" name="price" class="form-control" min="0" value="{{ $product->price }}" required></div>
                <div class="col-md-6 mb-3"><label class="form-label">Số lượng</label><input type="number" name="quantity" class="form-control" min="0" value="{{ $product->quantity }}" required></div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3"><label class="form-label">Chiều dài (cm)</label><input type="number" step="0.1" name="length_cm" class="form-control" min="0" value="{{ $product->length_cm }}"></div>
                <div class="col-md-4 mb-3"><label class="form-label">Chiều rộng (cm)</label><input type="number" step="0.1" name="width_cm" class="form-control" min="0" value="{{ $product->width_cm }}"></div>
                <div class="col-md-4 mb-3"><label class="form-label">Kích thước / cao (cm)</label><input type="number" step="0.1" name="height_cm" class="form-control" min="0" value="{{ $product->height_cm }}"></div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tình trạng</label>
                    <select name="condition" class="form-select" required>
                        @foreach ($conditions as $key => $label)
                            <option value="{{ $key }}" @selected($product->condition == $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3"><label class="form-label">Thương hiệu</label><input name="brand" class="form-control" value="{{ $product->brand }}"></div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label">Nơi bán</label><input name="location" class="form-control" value="{{ $product->location }}" placeholder="VD: TP.HCM"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Đơn vị vận chuyển</label><input name="shipping_unit" class="form-control" value="{{ $product->shipping_unit }}" placeholder="VD: Giao hàng nhanh"></div>
            </div>

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="available" @selected($product->status=='available')>Đang bán</option>
                    <option value="sold" @selected($product->status=='sold')>Đã bán hết</option>
                    <option value="hidden" @selected($product->status=='hidden')>Ẩn</option>
                </select>
            </div>

            <button class="btn btn-primary w-100">Cập nhật</button>
        </form>
    </div>
</div>
@endsection
