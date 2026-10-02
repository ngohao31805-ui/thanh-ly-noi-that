<?php $__env->startSection('title', 'Yêu cầu bán của tôi'); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Yêu cầu bán / thanh lý của tôi</h3>
    <a href="<?php echo e(route('seller.requests.create')); ?>" class="btn btn-primary">+ Gửi yêu cầu mới</a>
</div>

<table class="table bg-white align-middle">
    <thead><tr><th>Ảnh</th><th>Tiêu đề</th><th>Danh mục</th><th>Giá mong muốn</th><th>Giá thu mua</th><th>Trạng thái</th><th></th></tr></thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <?php if($r->image): ?>
                        <img src="<?php echo e(asset('storage/'.$r->image)); ?>" style="width:45px;height:45px;object-fit:cover" class="rounded">
                    <?php else: ?>
                        <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted" style="width:45px;height:45px">🛋️</div>
                    <?php endif; ?>
                </td>
                <td><?php echo e($r->title); ?></td>
                <td><?php echo e($r->category->name ?? '-'); ?></td>
                <td><?php echo e($r->expected_price ? number_format($r->expected_price).'₫' : '-'); ?></td>
                <td><?php echo e($r->offered_price ? number_format($r->offered_price).'₫' : '-'); ?></td>
                <td>
                    <?php
                        $badge = ['pending'=>'secondary','valuated'=>'warning','approved'=>'primary','rejected'=>'danger','completed'=>'success'][$r->status] ?? 'secondary';
                    ?>
                    <span class="badge bg-<?php echo e($badge); ?>"><?php echo e($r->status); ?></span>
                </td>
                <td><a href="<?php echo e(route('seller.requests.show', $r)); ?>" class="btn btn-sm btn-outline-primary">Chi tiết</a></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="7">Chưa có yêu cầu nào.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php echo e($requests->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.seller', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\thu-mua-noi-that\resources\views/seller/requests/index.blade.php ENDPATH**/ ?>