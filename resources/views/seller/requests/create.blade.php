@extends('layouts.seller')
@section('title', 'Gửi yêu cầu bán/thanh lý')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="mb-3">Gửi yêu cầu bán / thanh lý nội thất</h4>
                <form method="POST" action="{{ route('seller.requests.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề *</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Danh mục</label>
                        <select name="category_id" class="form-select">
                            <option value="">-- Chọn danh mục --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hình ảnh</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giá mong muốn (VNĐ)</label>
                        <input type="number" name="expected_price" class="form-control" value="{{ old('expected_price') }}" min="0">
                    </div>
                    <button class="btn btn-primary w-100">Gửi yêu cầu</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
