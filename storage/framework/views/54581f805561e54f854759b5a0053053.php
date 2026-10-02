<?php $__env->startSection('title', 'Quản trị hệ thống'); ?>
<?php $__env->startSection('content'); ?>
<h3>Bảng điều khiển Quản trị</h3>

<div class="row g-3 mb-4">
    <div class="col-md-2">
        <div class="card text-bg-secondary"><div class="card-body"><h6>Khách hàng</h6><h3><?php echo e($stats['total_customers']); ?></h3></div></div>
    </div>
    <div class="col-md-2">
        <div class="card" style="background:#198754;color:#fff"><div class="card-body"><h6>Người bán</h6><h3><?php echo e($stats['total_sellers']); ?></h3></div></div>
    </div>
    <div class="col-md-2">
        <div class="card" style="background:#fd7e14;color:#fff"><div class="card-body"><h6>NV thu mua</h6><h3><?php echo e($stats['total_buyers']); ?></h3></div></div>
    </div>
    <div class="col-md-2">
        <div class="card text-bg-warning"><div class="card-body"><h6>Yêu cầu chờ</h6><h3><?php echo e($stats['pending_requests']); ?></h3></div></div>
    </div>
    <div class="col-md-2">
        <div class="card text-bg-primary"><div class="card-body"><h6>Sản phẩm</h6><h3><?php echo e($stats['total_products']); ?></h3></div></div>
    </div>
    <div class="col-md-2">
        <div class="card text-bg-dark"><div class="card-body"><h6>Đơn hàng</h6><h3><?php echo e($stats['total_orders']); ?></h3></div></div>
    </div>
</div>
<div class="row g-3 mb-4">
    <div class="col-md-2">
        <div class="card text-bg-success"><div class="card-body"><h6>Doanh thu</h6><h5><?php echo e(number_format($stats['revenue'])); ?>₫</h5></div></div>
    </div>
</div>

<div class="d-flex gap-2 mb-4">
    <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-outline-secondary">Quản lý tài khoản</a>
    <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-outline-secondary">Danh mục</a>
    <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-outline-secondary">Kho sản phẩm</a>
    <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-outline-secondary">Đơn hàng</a>
</div>

<div class="row">
    <div class="col-md-6">
        <h5>Đơn hàng gần đây</h5>
        <table class="table bg-white">
            <thead><tr><th>Mã</th><th>Khách</th><th>Tổng</th><th>Trạng thái</th><th></th></tr></thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>#<?php echo e($o->id); ?></td>
                        <td><?php echo e($o->user->name); ?></td>
                        <td><?php echo e(number_format($o->total_price)); ?>₫</td>
                        <td><span class="badge bg-info"><?php echo e($o->status); ?></span></td>
                        <td><a href="<?php echo e(route('admin.orders.show', $o)); ?>" class="btn btn-sm btn-outline-primary">Xử lý</a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5">Chưa có đơn hàng.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <h5>Yêu cầu thu mua gần đây</h5>
        <table class="table bg-white">
            <thead><tr><th>Người bán</th><th>NV thu mua</th><th>Trạng thái</th></tr></thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $recentRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr><td><?php echo e($r->seller->name); ?></td><td><?php echo e($r->buyer->name ?? '-'); ?></td><td><?php echo e($r->status); ?></td></tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="3">Chưa có yêu cầu.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\thu-mua-noi-that\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>