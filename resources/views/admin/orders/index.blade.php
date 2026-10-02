@extends('layouts.admin')
@section('title', 'Quản lý đơn hàng')
@section('content')
<h3>Quản lý đơn hàng</h3>

<form method="GET" class="mb-3" style="max-width:250px">
    <select name="status" class="form-select" onchange="this.form.submit()">
        <option value="">Tất cả trạng thái</option>
        @foreach (['pending','confirmed','shipping','completed','cancelled'] as $s)
            <option value="{{ $s }}" @selected(request('status')==$s)>{{ $s }}</option>
        @endforeach
    </select>
</form>

<table class="table bg-white align-middle">
    <thead><tr><th>Mã</th><th>Khách hàng</th><th>Tổng tiền</th><th>Trạng thái</th><th>Ngày đặt</th><th style="width:340px">Xử lý</th></tr></thead>
    <tbody>
        @forelse ($orders as $o)
            <tr>
                <td>#{{ $o->id }}</td>
                <td>{{ $o->user->name }}</td>
                <td>{{ number_format($o->total_price) }}₫</td>
                <td><span class="badge bg-info">{{ $o->status }}</span></td>
                <td>{{ $o->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <form method="POST" action="{{ route('admin.orders.status', $o) }}" class="d-flex gap-1">
                            @csrf @method('PUT')
                            <select name="status" class="form-select form-select-sm">
                                @foreach (['pending','confirmed','shipping','completed','cancelled'] as $s)
                                    <option value="{{ $s }}" @selected($o->status==$s)>{{ $s }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-sm btn-primary">Cập nhật</button>
                        </form>
                        <a href="{{ route('admin.orders.show', $o) }}" class="btn btn-sm btn-outline-secondary">Chi tiết</a>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">Chưa có đơn hàng nào.</td></tr>
        @endforelse
    </tbody>
</table>
{{ $orders->links() }}
@endsection
