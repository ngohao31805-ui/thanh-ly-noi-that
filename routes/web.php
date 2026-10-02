<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Trang công khai
|--------------------------------------------------------------------------
*/
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Giỏ hàng & Đặt hàng (mọi người dùng đã đăng nhập)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{product}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
});

/*
|--------------------------------------------------------------------------
| Khu vực Seller (người bán / khách thanh lý nội thất)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:seller'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Seller\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/requests', [App\Http\Controllers\Seller\PurchaseRequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/create', [App\Http\Controllers\Seller\PurchaseRequestController::class, 'create'])->name('requests.create');
    Route::post('/requests', [App\Http\Controllers\Seller\PurchaseRequestController::class, 'store'])->name('requests.store');
    Route::get('/requests/{purchaseRequest}', [App\Http\Controllers\Seller\PurchaseRequestController::class, 'show'])->name('requests.show');
});

/*
|--------------------------------------------------------------------------
| Khu vực Buyer (nhân viên thu mua)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:buyer'])->prefix('buyer')->name('buyer.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Buyer\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/requests', [App\Http\Controllers\Buyer\PurchaseRequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/{purchaseRequest}', [App\Http\Controllers\Buyer\PurchaseRequestController::class, 'show'])->name('requests.show');
    Route::put('/requests/{purchaseRequest}/valuate', [App\Http\Controllers\Buyer\PurchaseRequestController::class, 'valuate'])->name('requests.valuate');
    Route::put('/requests/{purchaseRequest}/approve', [App\Http\Controllers\Buyer\PurchaseRequestController::class, 'approve'])->name('requests.approve');
    Route::put('/requests/{purchaseRequest}/reject', [App\Http\Controllers\Buyer\PurchaseRequestController::class, 'reject'])->name('requests.reject');
});

/*
|--------------------------------------------------------------------------
| Khu vực Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->except(['show']);
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class)->except(['show']);
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class)->except(['show']);

    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{order}/status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.status');
});
