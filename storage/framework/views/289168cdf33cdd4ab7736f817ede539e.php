<?php $__env->startSection('title', 'Gửi yêu cầu bán/thanh lý'); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="mb-3">Gửi yêu cầu bán / thanh lý nội thất</h4>
                <form method="POST" action="<?php echo e(route('seller.requests.store')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề *</label>
                        <input type="text" name="title" class="form-control" value="<?php echo e(old('title')); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Danh mục</label>
                        <select name="category_id" class="form-select">
                            <option value="">-- Chọn danh mục --</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea name="description" class="form-control" rows="4"><?php echo e(old('description')); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hình ảnh</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giá mong muốn (VNĐ)</label>
                        <input type="number" name="expected_price" class="form-control" value="<?php echo e(old('expected_price')); ?>" min="0">
                    </div>
                    <button class="btn btn-primary w-100">Gửi yêu cầu</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.seller', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\thu-mua-noi-that\resources\views/seller/requests/create.blade.php ENDPATH**/ ?>