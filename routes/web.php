<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CouponController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\OrderController;



Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/apply-coupon', [CouponController::class, 'applyCoupon'])->name('cart.apply-coupon');
Route::get('/product', [ProductController::class, 'product']);
Route::get('detail/{id}', [DetailController::class, 'detail'])->name('detail');


Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout');
Route::post('/process-order', [CheckoutController::class, 'processOrder'])->name('process.order');
Route::get('/thankyou', function () {
    return view('thankyou');
})->name('thank-you');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update-item', [CartController::class, 'updateItem'])->name('cart.update-item');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');


//check is_show
Route::get('/secure-route', [SecureController::class, 'index'])->middleware('check.is_show');



Route::prefix('admin')->middleware(AdminMiddleware::class)->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin');
    //san pham
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');

    Route::get('/products/add', [AdminController::class, 'addProduct'])->name('admin.add-product');
    Route::post('/products/add', [AdminController::class, 'storeProduct'])->name('admin.store-product');

    Route::get('/products/edit/{id}', [AdminController::class, 'editProduct'])->name('admin.edit-product');
    Route::post('/products/edit/{id}', [AdminController::class, 'updateProduct'])->name('admin.update-product');

    Route::get('/products/delete/{id}', [AdminController::class, 'deleteProduct'])->name('admin.delete-product');
    Route::get('/products/view/{id}', [AdminController::class, 'viewProduct'])->name('admin.view-product');

    //user


    Route::patch('/users/show/{id}', [UsersController::class, 'showUser'])->name('admin.users.show');


    Route::get('/users', [UsersController::class, 'users'])->name('admin.users');
    Route::get('/users/add', [UsersController::class, 'addUser'])->name('admin.add-user');
    Route::post('/users/add', [UsersController::class, 'storeUser'])->name('admin.store-user');

    Route::get('/admin/users/{id}/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [UsersController::class, 'update'])->name('admin.users.update');
    Route::patch('/admin/users/{id}/hide', [UsersController::class, 'hideUser'])->name('admin.users.hide');

    Route::delete('/admin/users/{id}', [UsersController::class, 'destroy'])->name('admin.users.destroy');
    Route::patch('/admin/users/{id}/restore', [UsersController::class, 'restoreUser'])->name('admin.users.restore');

    //don hang

    Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::put('/admin/orders/{id}/update-status', [OrderController::class, 'updateOrderStatus'])->name('admin.orders.updateStatus');

});



require __DIR__ . '/auth.php';