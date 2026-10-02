@extends('layouts.admin')
@section('title', 'Thêm danh mục')
@section('content')
<div class="card" style="max-width:500px">
    <div class="card-body">
        <h4>Thêm danh mục</h4>
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <div class="mb-3"><label class="form-label">Tên danh mục</label><input name="name" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Mô tả</label><textarea name="description" class="form-control"></textarea></div>
            <button class="btn btn-primary w-100">Thêm</button>
        </form>
    </div>
</div>
@endsection
