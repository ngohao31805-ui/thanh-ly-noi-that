@extends('layouts.admin')
@section('title', 'Thêm sản phẩm')
@section('content')
<div class="card" style="max-width:600px">
    <div class="card-body">
        <h4>Thêm sản phẩm vào kho</h4>
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3"><label class="form-label">Tên sản phẩm</label><input name="name" class="form-control" required></div>
            <div class="mb-3">
                <label class="form-label">Danh mục / Loại nội thất</label>
                <select name="category_id" class="form-select">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3"><label class="form-label">Mô tả</label><textarea name="description" class="form-control"></textarea></div>
            <div class="mb-3">
                <label class="form-label">Hình ảnh sản phẩm</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label">Giá bán (VNĐ)</label><input type="number" name="price" class="form-control" min="0" required></div>
                <div class="col-md-6 mb-3"><label class="form-label">Số lượng</label><input type="number" name="quantity" class="form-control" min="0" value="1" required></div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3"><label class="form-label">Chiều dài (cm)</label><input type="number" step="0.1" name="length_cm" class="form-control" min="0"></div>
                <div class="col-md-4 mb-3"><label class="form-label">Chiều rộng (cm)</label><input type="number" step="0.1" name="width_cm" class="form-control" min="0"></div>
                <div class="col-md-4 mb-3"><label class="form-label">Kích thước / cao (cm)</label><input type="number" step="0.1" name="height_cm" class="form-control" min="0"></div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tình trạng</label>
                    <select name="condition" class="form-select" required>
                        @foreach ($conditions as $key => $label)
                            <option value="{{ $key }}" @selected($key == 'used')>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3"><label class="form-label">Thương hiệu</label><input name="brand" class="form-control"></div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label">Nơi bán</label><input name="location" class="form-control" placeholder="VD: TP.HCM"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Đơn vị vận chuyển</label><input name="shipping_unit" class="form-control" placeholder="VD: Giao hàng nhanh"></div>
            </div>

            <button class="btn btn-primary w-100">Thêm sản phẩm</button>
        </form>
    </div>
</div>
@endsection
