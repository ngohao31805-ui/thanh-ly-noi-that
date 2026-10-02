<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Quản trị'); ?> — Thu Mua Nội Thất</title>
    <link href="https://cdn.jsdelivr.net/gh/StartBootstrap/startbootstrap-sb-admin@gh-pages/css/styles.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .sb-sidenav-dark .nav-link.active { background-color: rgba(255,255,255,.12); color:#fff; }
        .sb-sidenav-dark .sb-sidenav-footer { background-color: #0f1419; }
    </style>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="<?php echo e(route('admin.dashboard')); ?>">🛋️ Quản trị hệ thống</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="<?php echo e(route('products.index')); ?>" method="GET">
            <div class="input-group">
                <input class="form-control" type="text" name="search" placeholder="Tìm sản phẩm..." value="<?php echo e(request('search')); ?>">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4 align-items-center">
            <li class="nav-item me-2"><a class="btn btn-sm btn-outline-light" href="<?php echo e(route('home')); ?>"><i class="fas fa-house"></i> Trang chủ</a></li>
            <li class="nav-item me-2"><a class="btn btn-sm btn-outline-light" href="<?php echo e(route('cart.index')); ?>"><i class="fas fa-cart-shopping"></i> Giỏ hàng</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i> <?php echo e(auth()->user()->name); ?>

                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <form action="<?php echo e(route('logout')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button class="dropdown-item" type="submit">Đăng xuất</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Quản trị hệ thống</div>
                        <a class="nav-link <?php if(request()->routeIs('admin.dashboard')): ?> active <?php endif; ?>" href="<?php echo e(route('admin.dashboard')); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                            Bảng điều khiển
                        </a>
                        <a class="nav-link <?php if(request()->routeIs('admin.users.*')): ?> active <?php endif; ?>" href="<?php echo e(route('admin.users.index')); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Quản lý tài khoản
                        </a>
                        <a class="nav-link <?php if(request()->routeIs('admin.categories.*')): ?> active <?php endif; ?>" href="<?php echo e(route('admin.categories.index')); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-layer-group"></i></div>
                            Danh mục
                        </a>
                        <a class="nav-link <?php if(request()->routeIs('admin.products.*')): ?> active <?php endif; ?>" href="<?php echo e(route('admin.products.index')); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-boxes-stacked"></i></div>
                            Kho sản phẩm
                        </a>
                        <a class="nav-link <?php if(request()->routeIs('admin.orders.*')): ?> active <?php endif; ?>" href="<?php echo e(route('admin.orders.index')); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                            Đơn hàng
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Đăng nhập với vai trò:</div>
                    Quản trị viên
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 py-4">
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
            </main>
            <footer class="py-3 bg-light mt-auto border-top">
                <div class="container-fluid px-4">
                    <div class="text-muted small">Thu Mua Nội Thất &copy; <?php echo e(date('Y')); ?></div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            const sidebarToggle = document.body.querySelector('#sidebarToggle');
            if (sidebarToggle) {
                if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
                    document.body.classList.toggle('sb-sidenav-toggled');
                }
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.body.classList.toggle('sb-sidenav-toggled');
                    localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
                });
            }
        });
    </script>
</body>
</html>
<?php /**PATH D:\laragon\www\thu-mua-noi-that\resources\views/layouts/admin.blade.php ENDPATH**/ ?>