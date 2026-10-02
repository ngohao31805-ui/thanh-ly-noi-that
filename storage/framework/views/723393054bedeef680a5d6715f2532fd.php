<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Khách hàng'); ?> — Thu Mua Nội Thất</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background:#f1f3f6; }
        .panel-sidebar {
            width: 240px; min-height: 100vh; background: #1e2530;
            position: fixed; top: 0; left: 0; bottom: 0; padding-top: 1rem;
        }
        .panel-sidebar .brand { color:#fff; font-weight:700; font-size:1.1rem; padding:.5rem 1.25rem 1.5rem; display:block; text-decoration:none; }
        .panel-sidebar .nav-link { color:#b7c0cf; padding:.65rem 1.25rem; border-radius:0; display:flex; align-items:center; gap:.6rem; }
        .panel-sidebar .nav-link:hover { background:#29323f; color:#fff; }
        .panel-sidebar .nav-link.active { background:#6f42c1; color:#fff; }
        .panel-content { margin-left:240px; padding:1.75rem; }
        .panel-topbar { margin-left:240px; background:#fff; border-bottom:1px solid #e3e6eb; padding:.75rem 1.75rem; display:flex; justify-content:space-between; align-items:center; }
        @media (max-width: 768px) {
            .panel-sidebar { width:100%; min-height:auto; position:relative; }
            .panel-content, .panel-topbar { margin-left:0; }
        }
    </style>
</head>
<body>
    <div class="panel-sidebar">
        <a href="<?php echo e(route('products.index')); ?>" class="brand">🛋️ Khách hàng</a>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="<?php echo e(route('products.index')); ?>" class="nav-link <?php if(request()->routeIs('products.*')): ?> active <?php endif; ?>">🛍️ Sản phẩm</a></li>
            <li class="nav-item"><a href="<?php echo e(route('cart.index')); ?>" class="nav-link <?php if(request()->routeIs('cart.*')): ?> active <?php endif; ?>">🛒 Giỏ hàng</a></li>
            <li class="nav-item"><a href="<?php echo e(route('orders.index')); ?>" class="nav-link <?php if(request()->routeIs('orders.*')): ?> active <?php endif; ?>">🧾 Đơn hàng của tôi</a></li>
            <li><hr class="text-secondary mx-3"></li>
            <li class="nav-item">
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button class="nav-link border-0 bg-transparent w-100 text-start">🚪 Đăng xuất</button>
                </form>
            </li>
        </ul>
    </div>

    <div class="panel-topbar">
        <h5 class="mb-0"><?php echo $__env->yieldContent('title', 'Khách hàng'); ?></h5>
        <span class="text-muted">Xin chào, <strong><?php echo e(auth()->user()->name); ?></strong></span>
    </div>

    <div class="panel-content">
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH D:\laragon\www\thu-mua-noi-that\resources\views/layouts/customer.blade.php ENDPATH**/ ?>