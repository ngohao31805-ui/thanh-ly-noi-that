<?php $__env->startSection('title', 'Khu vực người bán'); ?>
<?php $__env->startSection('content'); ?>
<h3>Xin chào, <?php echo e(auth()->user()->name); ?> 👋</h3>
<a href="<?php echo e(route('seller.requests.create')); ?>" class="btn btn-primary mb-4">+ Gửi yêu cầu bán / thanh lý nội thất</a>

<div class="row">
    <div class="col-md-6">
        <h5>Yêu cầu gần đây của bạn</h5>
        <table class="table bg-white">
            <thead><tr><th>Tiêu đề</th><th>Giá đề xuất</th><th>Trạng thái</th></tr></thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $myRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><a href="<?php echo e(route('seller.requests.show', $r)); ?>"><?php echo e($r->title); ?></a></td>
                        <td><?php echo e($r->expected_price ? number_format($r->expected_price).'₫' : '-'); ?></td>
                        <td><span class="badge bg-secondary"><?php echo e($r->status); ?></span></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="3">Chưa có yêu cầu nào.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="<?php echo e(route('seller.requests.index')); ?>">Xem tất cả yêu cầu →</a>
    </div>
    <div class="col-md-6">
        <h5>Đơn hàng gần đây</h5>
        <table class="table bg-white">
            <thead><tr><th>Mã đơn</th><th>Tổng tiền</th><th>Trạng thái</th></tr></thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $myOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><a href="<?php echo e(route('orders.show', $o)); ?>">#<?php echo e($o->id); ?></a></td>
                        <td><?php echo e(number_format($o->total_price)); ?>₫</td>
                        <td><span class="badge bg-info"><?php echo e($o->status); ?></span></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="3">Chưa có đơn hàng nào.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.seller', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\thu-mua-noi-that\resources\views/seller/dashboard.blade.php ENDPATH**/ ?>