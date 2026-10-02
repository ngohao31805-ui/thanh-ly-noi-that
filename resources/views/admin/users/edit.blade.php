@extends('layouts.admin')
@section('title', 'Sửa tài khoản')
@section('content')
<div class="card" style="max-width:500px">
    <div class="card-body">
        <h4>Sửa tài khoản</h4>
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf @method('PUT')
            <div class="mb-3"><label class="form-label">Tên</label><input name="name" class="form-control" value="{{ $user->name }}" required></div>
            <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ $user->email }}" required></div>
            <div class="mb-3"><label class="form-label">Điện thoại</label><input name="phone" class="form-control" value="{{ $user->phone }}"></div>
            <div class="mb-3">
                <label class="form-label">Vai trò</label>
                <select name="role" class="form-select" required>
                    <option value="customer" @selected($user->role=='customer')>Customer (Khách hàng)</option>
                    <option value="seller" @selected($user->role=='seller')>Seller (Người bán/thanh lý)</option>
                    <option value="buyer" @selected($user->role=='buyer')>Buyer (NV thu mua)</option>
                    <option value="admin" @selected($user->role=='admin')>Admin</option>
                </select>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" name="is_active" value="1" class="form-check-input" id="active" @checked($user->is_active)>
                <label class="form-check-label" for="active">Tài khoản hoạt động</label>
            </div>
            <button class="btn btn-primary w-100">Cập nhật</button>
        </form>
    </div>
</div>
@endsection
