<?php $__env->startSection('title', 'Danh mục'); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Danh mục sản phẩm</h3>
    <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-primary">+ Thêm danh mục</a>
</div>
<table class="table bg-white">
    <thead><tr><th>Tên</th><th>Mô tả</th><th>Số sản phẩm</th><th></th></tr></thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($c->name); ?></td>
                <td><?php echo e($c->description); ?></td>
                <td><?php echo e($c->products_count); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.categories.edit', $c)); ?>" class="btn btn-sm btn-outline-primary">Sửa</a>
                    <form method="POST" action="<?php echo e(route('admin.categories.destroy', $c)); ?>" class="d-inline" onsubmit="return confirm('Xóa danh mục này?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-sm btn-outline-danger">Xóa</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="4">Chưa có danh mục nào.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php echo e($categories->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\thu-mua-noi-that\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>