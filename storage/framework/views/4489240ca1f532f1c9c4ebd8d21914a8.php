<?php $__env->startSection('title', $product->name); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-5">
        <?php if($product->image): ?>
            <img src="<?php echo e(asset('storage/'.$product->image)); ?>" class="img-fluid rounded shadow-sm">
        <?php else: ?>
            <div class="bg-light d-flex align-items-center justify-content-center text-muted rounded" style="height:280px;font-size:3rem">🛋️</div>
        <?php endif; ?>
    </div>
    <div class="col-md-7">
        <h3><?php echo e($product->name); ?></h3>
        <p class="text-muted"><?php echo e($product->category->name ?? 'Chưa phân loại'); ?></p>
        <p><?php echo e($product->description); ?></p>

        <table class="table table-sm w-auto">
            <tbody>
                <?php if($product->brand): ?>
                    <tr><th class="text-muted">Thương hiệu</th><td><?php echo e($product->brand); ?></td></tr>
                <?php endif; ?>
                <tr><th class="text-muted">Tình trạng</th><td><?php echo e($product->conditionLabel()); ?></td></tr>
                <?php if($product->length_cm || $product->width_cm || $product->height_cm): ?>
                    <tr><th class="text-muted">Kích thước (D x R x C)</th><td><?php echo e($product->length_cm ?? '?'); ?> x <?php echo e($product->width_cm ?? '?'); ?> x <?php echo e($product->height_cm ?? '?'); ?> cm</td></tr>
                <?php endif; ?>
                <?php if($product->location): ?>
                    <tr><th class="text-muted">Nơi bán</th><td><?php echo e($product->location); ?></td></tr>
                <?php endif; ?>
                <?php if($product->shipping_unit): ?>
                    <tr><th class="text-muted">Đơn vị vận chuyển</th><td><?php echo e($product->shipping_unit); ?></td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h4 class="text-danger"><?php echo e(number_format($product->price)); ?>₫</h4>
        <p>Còn lại: <?php echo e($product->quantity); ?> sản phẩm</p>

        <?php if(auth()->guard()->check()): ?>
            <form method="POST" action="<?php echo e(route('cart.add', $product)); ?>" class="d-flex gap-2">
                <?php echo csrf_field(); ?>
                <input type="number" name="quantity" value="1" min="1" max="<?php echo e($product->quantity); ?>" class="form-control" style="width: 100px">
                <button class="btn btn-primary" <?php if($product->status !== 'available'): echo 'disabled'; endif; ?>>Thêm vào giỏ</button>
            </form>
        <?php else: ?>
            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary">Đăng nhập để mua hàng</a>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(auth()->check() ? auth()->user()->panelLayout() : 'layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\thu-mua-noi-that\resources\views/products/show.blade.php ENDPATH**/ ?>