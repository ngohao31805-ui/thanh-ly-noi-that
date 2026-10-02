<?php $__env->startSection('title', 'Quản lý tài khoản'); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Quản lý tài khoản</h3>
    <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-primary">+ Thêm tài khoản</a>
</div>

<form method="GET" class="mb-3 d-flex gap-2" style="max-width:500px">
    <select name="role" class="form-select" onchange="this.form.submit()">
        <option value="">Tất cả vai trò</option>
        <option value="customer" <?php if(request('role')=='customer'): echo 'selected'; endif; ?>>Customer (Khách hàng)</option>
        <option value="seller" <?php if(request('role')=='seller'): echo 'selected'; endif; ?>>Seller (Người bán/thanh lý)</option>
        <option value="buyer" <?php if(request('role')=='buyer'): echo 'selected'; endif; ?>>Buyer (NV thu mua)</option>
        <option value="admin" <?php if(request('role')=='admin'): echo 'selected'; endif; ?>>Admin</option>
    </select>
    <input type="text" name="search" class="form-control" placeholder="Tìm tên/email" value="<?php echo e(request('search')); ?>">
    <button class="btn btn-outline-primary">Lọc</button>
</form>

<table class="table bg-white">
    <thead><tr><th>Tên</th><th>Email</th><th>Vai trò</th><th>Trạng thái</th><th></th></tr></thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($u->name); ?></td>
                <td><?php echo e($u->email); ?></td>
                <td><span class="badge bg-secondary"><?php echo e($u->role); ?></span></td>
                <td><?php echo e($u->is_active ? 'Hoạt động' : 'Khóa'); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.users.edit', $u)); ?>" class="btn btn-sm btn-outline-primary">Sửa</a>
                    <form method="POST" action="<?php echo e(route('admin.users.destroy', $u)); ?>" class="d-inline" onsubmit="return confirm('Xóa tài khoản này?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-sm btn-outline-danger">Xóa</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="5">Không có tài khoản nào.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php echo e($users->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\thu-mua-noi-that\resources\views/admin/users/index.blade.php ENDPATH**/ ?>