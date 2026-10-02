<?php $__env->startSection('title', 'Giỏ hàng'); ?>
<?php $__env->startSection('content'); ?>
<h3>Giỏ hàng của bạn</h3>

<?php if($products->isEmpty()): ?>
    <p>Giỏ hàng trống. <a href="<?php echo e(route('products.index')); ?>">Tiếp tục mua sắm</a></p>
<?php else: ?>
    <table class="table bg-white">
        <thead>
            <tr><th>Sản phẩm</th><th>Đơn giá</th><th>Số lượng</th><th>Thành tiền</th><th></th></tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $subtotal = $product->price * $cart[$product->id]; $total += $subtotal; ?>
                <tr>
                    <td><?php echo e($product->name); ?></td>
                    <td><?php echo e(number_format($product->price)); ?>₫</td>
                    <td><?php echo e($cart[$product->id]); ?></td>
                    <td><?php echo e(number_format($subtotal)); ?>₫</td>
                    <td>
                        <form method="POST" action="<?php echo e(route('cart.remove', $product)); ?>">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-sm btn-outline-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <h5>Tổng cộng: <span class="text-danger"><?php echo e(number_format($total)); ?>₫</span></h5>

    <form method="POST" action="<?php echo e(route('checkout')); ?>" class="card p-3 mt-3">
        <?php echo csrf_field(); ?>
        <h5>Thông tin giao hàng</h5>
        <div class="mb-3">
            <label class="form-label">Địa chỉ giao hàng</label>
            <input type="text" name="shipping_address" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <button class="btn btn-success">Đặt hàng</button>
    </form>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(auth()->check() ? auth()->user()->panelLayout() : 'layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\thu-mua-noi-that\resources\views/orders/cart.blade.php ENDPATH**/ ?>