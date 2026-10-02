<?php $__env->startSection('title', 'Bảng điều khiển Thu mua'); ?>
<?php $__env->startSection('content'); ?>
<h3>Bảng điều khiển Nhân viên thu mua</h3>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-bg-secondary"><div class="card-body">
            <h6>Chờ xử lý</h6><h3><?php echo e($stats['pending']); ?></h3>
        </div></div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-warning"><div class="card-body">
            <h6>Đã định giá</h6><h3><?php echo e($stats['valuated']); ?></h3>
        </div></div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-primary"><div class="card-body">
            <h6>Tôi đã chốt</h6><h3><?php echo e($stats['my_approved']); ?></h3>
        </div></div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-success"><div class="card-body">
            <h6>Tôi đã hoàn tất</h6><h3><?php echo e($stats['my_completed']); ?></h3>
        </div></div>
    </div>
</div>

<h5>Yêu cầu mới chờ xử lý</h5>
<table class="table bg-white">
    <thead><tr><th>Người bán</th><th>Tiêu đề</th><th>Giá mong muốn</th><th></th></tr></thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $newRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($r->seller->name); ?></td>
                <td><?php echo e($r->title); ?></td>
                <td><?php echo e($r->expected_price ? number_format($r->expected_price).'₫' : '-'); ?></td>
                <td><a href="<?php echo e(route('buyer.requests.show', $r)); ?>" class="btn btn-sm btn-outline-primary">Xử lý</a></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="4">Không có yêu cầu mới.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<a href="<?php echo e(route('buyer.requests.index')); ?>">Xem tất cả yêu cầu →</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.buyer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\thu-mua-noi-that\resources\views/buyer/dashboard.blade.php ENDPATH**/ ?>