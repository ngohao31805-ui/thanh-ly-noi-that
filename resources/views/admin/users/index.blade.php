@extends('layouts.admin')
@section('title', 'Quản lý tài khoản')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Quản lý tài khoản</h3>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ Thêm tài khoản</a>
</div>

<form method="GET" class="mb-3 d-flex gap-2" style="max-width:500px">
    <select name="role" class="form-select" onchange="this.form.submit()">
        <option value="">Tất cả vai trò</option>
        <option value="customer" @selected(request('role')=='customer')>Customer (Khách hàng)</option>
        <option value="seller" @selected(request('role')=='seller')>Seller (Người bán/thanh lý)</option>
        <option value="buyer" @selected(request('role')=='buyer')>Buyer (NV thu mua)</option>
        <option value="admin" @selected(request('role')=='admin')>Admin</option>
    </select>
    <input type="text" name="search" class="form-control" placeholder="Tìm tên/email" value="{{ request('search') }}">
    <button class="btn btn-outline-primary">Lọc</button>
</form>

<table class="table bg-white">
    <thead><tr><th>Tên</th><th>Email</th><th>Vai trò</th><th>Trạng thái</th><th></th></tr></thead>
    <tbody>
        @forelse ($users as $u)
            <tr>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td><span class="badge bg-secondary">{{ $u->role }}</span></td>
                <td>{{ $u->is_active ? 'Hoạt động' : 'Khóa' }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $u) }}" class="btn btn-sm btn-outline-primary">Sửa</a>
                    <form method="POST" action="{{ route('admin.users.destroy', $u) }}" class="d-inline" onsubmit="return confirm('Xóa tài khoản này?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Xóa</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">Không có tài khoản nào.</td></tr>
        @endforelse
    </tbody>
</table>
{{ $users->links() }}
@endsection
