<?php $__env->startSection('title', 'Sản phẩm nội thất'); ?>
<?php $__env->startSection('content'); ?>
<h3 class="mb-4">Nội thất đã thu mua & sẵn sàng bán lại</h3>

<div class="row g-4">
    
    <div class="col-md-3">
        <form method="GET" class="card p-3 shadow-sm">
            <h6 class="mb-3">Bộ lọc tìm kiếm</h6>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Từ khóa</label>
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Tìm kiếm..." value="<?php echo e(request('search')); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Loại nội thất</label>
                <select name="category_id" class="form-select form-select-sm">
                    <option value="">Tất cả danh mục</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat->id); ?>" <?php if(request('category_id') == $cat->id): echo 'selected'; endif; ?>><?php echo e($cat->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Khoảng giá (₫)</label>
                <div class="d-flex gap-2">
                    <input type="number" name="price_min" class="form-control form-control-sm" placeholder="Từ" value="<?php echo e(request('price_min')); ?>">
                    <input type="number" name="price_max" class="form-control form-control-sm" placeholder="Đến" value="<?php echo e(request('price_max')); ?>">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Chiều dài (cm)</label>
                <div class="d-flex gap-2">
                    <input type="number" name="length_min" class="form-control form-control-sm" placeholder="Từ" value="<?php echo e(request('length_min')); ?>">
                    <input type="number" name="length_max" class="form-control form-control-sm" placeholder="Đến" value="<?php echo e(request('length_max')); ?>">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Chiều rộng (cm)</label>
                <div class="d-flex gap-2">
                    <input type="number" name="width_min" class="form-control form-control-sm" placeholder="Từ" value="<?php echo e(request('width_min')); ?>">
                    <input type="number" name="width_max" class="form-control form-control-sm" placeholder="Đến" value="<?php echo e(request('width_max')); ?>">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Kích thước (chiều cao, cm)</label>
                <div class="d-flex gap-2">
                    <input type="number" name="height_min" class="form-control form-control-sm" placeholder="Từ" value="<?php echo e(request('height_min')); ?>">
                    <input type="number" name="height_max" class="form-control form-control-sm" placeholder="Đến" value="<?php echo e(request('height_max')); ?>">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Tình trạng</label>
                <select name="condition" class="form-select form-select-sm">
                    <option value="">Tất cả</option>
                    <?php $__currentLoopData = $conditions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php if(request('condition') == $key): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Thương hiệu</label>
                <select name="brand" class="form-select form-select-sm">
                    <option value="">Tất cả</option>
                    <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($b); ?>" <?php if(request('brand') == $b): echo 'selected'; endif; ?>><?php echo e($b); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Nơi bán</label>
                <select name="location" class="form-select form-select-sm">
                    <option value="">Tất cả</option>
                    <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($loc); ?>" <?php if(request('location') == $loc): echo 'selected'; endif; ?>><?php echo e($loc); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Đơn vị vận chuyển</label>
                <select name="shipping_unit" class="form-select form-select-sm">
                    <option value="">Tất cả</option>
                    <?php $__currentLoopData = $shippingUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($s); ?>" <?php if(request('shipping_unit') == $s): echo 'selected'; endif; ?>><?php echo e($s); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <button class="btn btn-primary btn-sm">Lọc</button>
            <a href="<?php echo e(route('products.index')); ?>" class="btn btn-outline-secondary btn-sm mt-2">Xóa bộ lọc</a>
        </form>
    </div>

    
    <div class="col-md-9">
        <div class="row g-4">
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <?php if($product->image): ?>
                            <img src="<?php echo e(asset('storage/'.$product->image)); ?>" class="card-img-top" style="height:180px;object-fit:cover">
                        <?php else: ?>
                            <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height:180px;font-size:2.5rem">🛋️</div>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($product->name); ?></h5>
                            <p class="text-muted small mb-1"><?php echo e($product->category->name ?? 'Chưa phân loại'); ?></p>
                            <p class="text-muted small mb-1">
                                <?php if($product->brand): ?> <?php echo e($product->brand); ?> &middot; <?php endif; ?>
                                <?php echo e($product->conditionLabel()); ?>

                            </p>
                            <?php if($product->length_cm || $product->width_cm || $product->height_cm): ?>
                                <p class="text-muted small mb-1">
                                    Kích thước: <?php echo e($product->length_cm ?? '?'); ?> x <?php echo e($product->width_cm ?? '?'); ?> x <?php echo e($product->height_cm ?? '?'); ?> cm
                                </p>
                            <?php endif; ?>
                            <?php if($product->location): ?>
                                <p class="text-muted small mb-1">📍 <?php echo e($product->location); ?></p>
                            <?php endif; ?>
                            <p class="fw-bold text-danger"><?php echo e(number_format($product->price)); ?>₫</p>
                            <a href="<?php echo e(route('products.show', $product)); ?>" class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p>Không tìm thấy sản phẩm phù hợp với bộ lọc.</p>
            <?php endif; ?>
        </div>

        <div class="mt-4"><?php echo e($products->links()); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(auth()->check() ? auth()->user()->panelLayout() : 'layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\thu-mua-noi-that\resources\views/products/index.blade.php ENDPATH**/ ?>