<?php $__env->startSection('title', 'Chi tiết yêu cầu'); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-body">
        <h4><?php echo e($purchaseRequest->title); ?></h4>
        <p class="text-muted"><?php echo e($purchaseRequest->category->name ?? 'Chưa phân loại'); ?></p>
        <?php if($purchaseRequest->image): ?>
            <img src="<?php echo e(asset('storage/'.$purchaseRequest->image)); ?>" class="img-fluid mb-3" style="max-width:300px">
        <?php endif; ?>
        <p><?php echo e($purchaseRequest->description); ?></p>
        <p>Giá mong muốn: <strong><?php echo e($purchaseRequest->expected_price ? number_format($purchaseRequest->expected_price).'₫' : '-'); ?></strong></p>
        <p>Giá thu mua đề xuất: <strong><?php echo e($purchaseRequest->offered_price ? number_format($purchaseRequest->offered_price).'₫' : 'Chưa định giá'); ?></strong></p>
        <?php if($purchaseRequest->buyer_note): ?>
            <div class="alert alert-info">Ghi chú từ NV thu mua: <?php echo e($purchaseRequest->buyer_note); ?></div>
        <?php endif; ?>
        <span class="badge bg-secondary"><?php echo e($purchaseRequest->status); ?></span>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.seller', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\thu-mua-noi-that\resources\views/seller/requests/show.blade.php ENDPATH**/ ?>