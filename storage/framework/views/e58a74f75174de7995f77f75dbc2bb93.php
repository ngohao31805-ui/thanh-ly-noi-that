<?php $__env->startSection('title', 'Kho sản phẩm'); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Kho sản phẩm (hàng bán lại)</h3>
    <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary">+ Thêm sản phẩm</a>
</div>

<form method="GET" class="mb-3" style="max-width:250px">
    <select name="status" class="form-select" onchange="this.form.submit()">
        <option value="">Tất cả trạng thái</option>
        <option value="available" <?php if(request('status')=='available'): echo 'selected'; endif; ?>>Đang bán</option>
        <option value="sold" <?php if(request('status')=='sold'): echo 'selected'; endif; ?>>Đã bán hết</option>
        <option value="hidden" <?php if(request('status')=='hidden'): echo 'selected'; endif; ?>>Ẩn</option>
    </select>
</form>

<table class="table bg-white align-middle">
    <thead><tr><th>Ảnh</th><th>Tên</th><th>Danh mục</th><th>Giá</th><th>SL</th><th>Trạng thái</th><th></th></tr></thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <?php if($p->image): ?>
                        <img src="<?php echo e(asset('storage/'.$p->image)); ?>" style="width:50px;height:50px;object-fit:cover" class="rounded">
                    <?php else: ?>
                        <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted" style="width:50px;height:50px;font-size:1.2rem">🛋️</div>
                    <?php endif; ?>
                </td>
                <td><?php echo e($p->name); ?></td>
                <td><?php echo e($p->category->name ?? '-'); ?></td>
                <td><?php echo e(number_format($p->price)); ?>₫</td>
                <td><?php echo e($p->quantity); ?></td>
                <td><span class="badge bg-secondary"><?php echo e($p->status); ?></span></td>
                <td>
                    <a href="<?php echo e(route('admin.products.edit', $p)); ?>" class="btn btn-sm btn-outline-primary">Sửa</a>
                    <form method="POST" action="<?php echo e(route('admin.products.destroy', $p)); ?>" class="d-inline" onsubmit="return confirm('Xóa sản phẩm này?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-sm btn-outline-danger">Xóa</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="7">Chưa có sản phẩm nào.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php echo e($products->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\thu-mua-noi-that\resources\views/admin/products/index.blade.php ENDPATH**/ ?>