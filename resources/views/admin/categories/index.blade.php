@extends('layouts.admin')
@section('title', 'Danh mục')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Danh mục sản phẩm</h3>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Thêm danh mục</a>
</div>
<table class="table bg-white">
    <thead><tr><th>Tên</th><th>Mô tả</th><th>Số sản phẩm</th><th></th></tr></thead>
    <tbody>
        @forelse ($categories as $c)
            <tr>
                <td>{{ $c->name }}</td>
                <td>{{ $c->description }}</td>
                <td>{{ $c->products_count }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $c) }}" class="btn btn-sm btn-outline-primary">Sửa</a>
                    <form method="POST" action="{{ route('admin.categories.destroy', $c) }}" class="d-inline" onsubmit="return confirm('Xóa danh mục này?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Xóa</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Chưa có danh mục nào.</td></tr>
        @endforelse
    </tbody>
</table>
{{ $categories->links() }}
@endsection
