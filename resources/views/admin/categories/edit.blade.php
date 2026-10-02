@extends('layouts.admin')
@section('title', 'Sửa danh mục')
@section('content')
<div class="card" style="max-width:500px">
    <div class="card-body">
        <h4>Sửa danh mục</h4>
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf @method('PUT')
            <div class="mb-3"><label class="form-label">Tên danh mục</label><input name="name" class="form-control" value="{{ $category->name }}" required></div>
            <div class="mb-3"><label class="form-label">Mô tả</label><textarea name="description" class="form-control">{{ $category->description }}</textarea></div>
            <button class="btn btn-primary w-100">Cập nhật</button>
        </form>
    </div>
</div>
@endsection
