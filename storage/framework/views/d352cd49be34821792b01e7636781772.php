<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Thu Mua Nội Thất'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">🛋️ Thu Mua Nội Thất</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('home')); ?>">🏠 Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('products.index')); ?>">Sản phẩm</a></li>
                </ul>
                <form action="<?php echo e(route('products.index')); ?>" method="GET" class="d-flex me-3" style="width:280px">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Tìm sản phẩm..." value="<?php echo e(request('search')); ?>">
                    <button class="btn btn-sm btn-outline-light ms-1">🔍</button>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>">Đăng nhập</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('register')); ?>">Đăng ký</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4">
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
<?php /**PATH D:\laragon\www\thu-mua-noi-that\resources\views/layouts/guest.blade.php ENDPATH**/ ?>