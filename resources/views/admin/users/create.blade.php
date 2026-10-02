@extends('layouts.admin')
@section('title', 'Thêm tài khoản')
@section('content')
<div class="card" style="max-width:500px">
    <div class="card-body">
        <h4>Thêm tài khoản mới</h4>
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="mb-3"><label class="form-label">Tên</label><input name="name" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Điện thoại</label><input name="phone" class="form-control"></div>
            <div class="mb-3"><label class="form-label">Mật khẩu</label><input type="password" name="password" class="form-control" required></div>
            <div class="mb-3">
                <label class="form-label">Vai trò</label>
                <select name="role" class="form-select" required>
                    <option value="customer">Customer (Khách hàng)</option>
                    <option value="seller">Seller (Người bán/thanh lý)</option>
                    <option value="buyer">Buyer (NV thu mua)</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button class="btn btn-primary w-100">Tạo tài khoản</button>
        </form>
    </div>
</div>
@endsection
