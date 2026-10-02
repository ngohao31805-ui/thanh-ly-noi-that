<?php $__env->startSection('title', 'Quản lý đơn hàng'); ?>
<?php $__env->startSection('content'); ?>
<h3>Quản lý đơn hàng</h3>

<form method="GET" class="mb-3" style="max-width:250px">
    <select name="status" class="form-select" onchange="this.form.submit()">
        <option value="">Tất cả trạng thái</option>
        <?php $__currentLoopData = ['pending','confirmed','shipping','completed','cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($s); ?>" <?php if(request('status')==$s): echo 'selected'; endif; ?>><?php echo e($s); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</form>

<table class="table bg-white align-middle">
    <thead><tr><th>Mã</th><th>Khách hàng</th><th>Tổng tiền</th><th>Trạng thái</th><th>Ngày đặt</th><th style="width:340px">Xử lý</th></tr></thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>#<?php echo e($o->id); ?></td>
                <td><?php echo e($o->user->name); ?></td>
                <td><?php echo e(number_format($o->total_price)); ?>₫</td>
                <td><span class="badge bg-info"><?php echo e($o->status); ?></span></td>
                <td><?php echo e($o->created_at->format('d/m/Y H:i')); ?></td>
                <td>
                    <div class="d-flex gap-2">
                        <form method="POST" action="<?php echo e(route('admin.orders.status', $o)); ?>" class="d-flex gap-1">
                            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                            <select name="status" class="form-select form-select-sm">
                                <?php $__currentLoopData = ['pending','confirmed','shipping','completed','cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($s); ?>" <?php if($o->status==$s): echo 'selected'; endif; ?>><?php echo e($s); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <button class="btn btn-sm btn-primary">Cập nhật</button>
                        </form>
                        <a href="<?php echo e(route('admin.orders.show', $o)); ?>" class="btn btn-sm btn-outline-secondary">Chi tiết</a>
                    </div>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="6">Chưa có đơn hàng nào.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php echo e($orders->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\thu-mua-noi-that\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>