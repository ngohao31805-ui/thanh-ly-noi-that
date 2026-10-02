<?php $__env->startSection('title', 'Danh sách yêu cầu thu mua'); ?>
<?php $__env->startSection('content'); ?>
<h3>Danh sách yêu cầu bán / thanh lý</h3>

<form method="GET" class="mb-3 d-flex gap-2" style="max-width:300px">
    <select name="status" class="form-select" onchange="this.form.submit()">
        <option value="">Tất cả trạng thái</option>
        <?php $__currentLoopData = ['pending','valuated','approved','rejected','completed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($s); ?>" <?php if(request('status')==$s): echo 'selected'; endif; ?>><?php echo e($s); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</form>

<table class="table bg-white align-middle">
    <thead><tr><th>Ảnh</th><th>Người bán</th><th>Tiêu đề</th><th>Giá mong muốn</th><th>Giá đề xuất</th><th>Trạng thái</th><th></th></tr></thead>
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
                <td><?php echo e($r->seller->name); ?></td>
                <td><?php echo e($r->title); ?></td>
                <td><?php echo e($r->expected_price ? number_format($r->expected_price).'₫' : '-'); ?></td>
                <td><?php echo e($r->offered_price ? number_format($r->offered_price).'₫' : '-'); ?></td>
                <td><span class="badge bg-secondary"><?php echo e($r->status); ?></span></td>
                <td><a href="<?php echo e(route('buyer.requests.show', $r)); ?>" class="btn btn-sm btn-outline-primary">Chi tiết</a></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="7">Không có yêu cầu nào.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php echo e($requests->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.buyer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\thu-mua-noi-that\resources\views/buyer/requests/index.blade.php ENDPATH**/ ?>