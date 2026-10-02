<?php $__env->startSection('title', 'Xử lý yêu cầu'); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <h4><?php echo e($purchaseRequest->title); ?></h4>
                <p class="text-muted">Người bán: <?php echo e($purchaseRequest->seller->name); ?> — <?php echo e($purchaseRequest->seller->phone); ?></p>
                <?php if($purchaseRequest->image): ?>
                    <img src="<?php echo e(asset('storage/'.$purchaseRequest->image)); ?>" class="img-fluid mb-3" style="max-width:300px">
                <?php endif; ?>
                <p><?php echo e($purchaseRequest->description); ?></p>
                <p>Danh mục: <?php echo e($purchaseRequest->category->name ?? '-'); ?></p>
                <p>Giá mong muốn: <strong><?php echo e($purchaseRequest->expected_price ? number_format($purchaseRequest->expected_price).'₫' : '-'); ?></strong></p>
                <span class="badge bg-secondary"><?php echo e($purchaseRequest->status); ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <?php if(in_array($purchaseRequest->status, ['pending', 'valuated'])): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Định giá thu mua</h5>
                    <form method="POST" action="<?php echo e(route('buyer.requests.valuate', $purchaseRequest)); ?>">
                        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                        <div class="mb-3">
                            <label class="form-label">Giá đề xuất thu mua (VNĐ)</label>
                            <input type="number" name="offered_price" class="form-control" value="<?php echo e($purchaseRequest->offered_price); ?>" min="0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ghi chú</label>
                            <textarea name="buyer_note" class="form-control"><?php echo e($purchaseRequest->buyer_note); ?></textarea>
                        </div>
                        <button class="btn btn-warning w-100">Lưu định giá</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <?php if($purchaseRequest->status === 'valuated'): ?>
            <form method="POST" action="<?php echo e(route('buyer.requests.approve', $purchaseRequest)); ?>" class="mb-2">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <button class="btn btn-primary w-100">✔ Chốt thu mua (đưa vào kho bán lại)</button>
            </form>
        <?php endif; ?>

        <?php if(!in_array($purchaseRequest->status, ['rejected', 'completed'])): ?>
            <form method="POST" action="<?php echo e(route('buyer.requests.reject', $purchaseRequest)); ?>">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <input type="text" name="buyer_note" class="form-control mb-2" placeholder="Lý do từ chối (tuỳ chọn)">
                <button class="btn btn-outline-danger w-100">✖ Từ chối yêu cầu</button>
            </form>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.buyer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\thu-mua-noi-that\resources\views/buyer/requests/show.blade.php ENDPATH**/ ?>