<?php $__env->startSection('title', 'Đơn hàng của tôi'); ?>
<?php $__env->startSection('content'); ?>
<h3>Đơn hàng của tôi</h3>
<table class="table bg-white">
    <thead><tr><th>Mã đơn</th><th>Tổng tiền</th><th>Trạng thái</th><th>Ngày đặt</th><th></th></tr></thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>#<?php echo e($order->id); ?></td>
                <td><?php echo e(number_format($order->total_price)); ?>₫</td>
                <td><span class="badge bg-info"><?php echo e($order->status); ?></span></td>
                <td><?php echo e($order->created_at->format('d/m/Y H:i')); ?></td>
                <td><a href="<?php echo e(route('orders.show', $order)); ?>" class="btn btn-sm btn-outline-primary">Xem</a></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="5">Chưa có đơn hàng nào.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php echo e($orders->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(auth()->check() ? auth()->user()->panelLayout() : 'layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\thu-mua-noi-that\resources\views/orders/index.blade.php ENDPATH**/ ?>