@extends('layouts.admin')
@section('title', 'Kho sản phẩm')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Kho sản phẩm (hàng bán lại)</h3>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Thêm sản phẩm</a>
</div>

<form method="GET" class="mb-3" style="max-width:250px">
    <select name="status" class="form-select" onchange="this.form.submit()">
        <option value="">Tất cả trạng thái</option>
        <option value="available" @selected(request('status')=='available')>Đang bán</option>
        <option value="sold" @selected(request('status')=='sold')>Đã bán hết</option>
        <option value="hidden" @selected(request('status')=='hidden')>Ẩn</option>
    </select>
</form>

<table class="table bg-white align-middle">
    <thead><tr><th>Ảnh</th><th>Tên</th><th>Danh mục</th><th>Giá</th><th>SL</th><th>Trạng thái</th><th></th></tr></thead>
    <tbody>
        @forelse ($products as $p)
            <tr>
                <td>
                    @if ($p->image)
                        <img src="{{ asset('storage/'.$p->image) }}" style="width:50px;height:50px;object-fit:cover" class="rounded">
                    @else
                        <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted" style="width:50px;height:50px;font-size:1.2rem">🛋️</div>
                    @endif
                </td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->category->name ?? '-' }}</td>
                <td>{{ number_format($p->price) }}₫</td>
                <td>{{ $p->quantity }}</td>
                <td><span class="badge bg-secondary">{{ $p->status }}</span></td>
                <td>
                    <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-sm btn-outline-primary">Sửa</a>
                    <form method="POST" action="{{ route('admin.products.destroy', $p) }}" class="d-inline" onsubmit="return confirm('Xóa sản phẩm này?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Xóa</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7">Chưa có sản phẩm nào.</td></tr>
        @endforelse
    </tbody>
</table>
{{ $products->links() }}
@endsection
