<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DealsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewArrivalsController;
use App\Http\Controllers\OrderThankYouController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CustomerAdminController;
use App\Http\Controllers\Admin\ReportAdminController;
use App\Http\Controllers\Admin\ReviewAdminController;
use App\Http\Controllers\Admin\CouponAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/deals', [DealsController::class, 'index'])->name('deals');
Route::get('/new-arrivals', [NewArrivalsController::class, 'index'])->name('new_arrivals');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
Route::get('/orders/{order}/thank-you', OrderThankYouController::class)->name('order.thankyou');


Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

// Admin (সরলভাবে auth দিয়ে protect; বাস্তবে role/permission যোগ করবেন)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductAdminController::class)->names('products');
    Route::delete('/products/images/{image}', [ProductAdminController::class, 'destroyImage'])->name('products.images.destroy');
    Route::resource('categories', CategoryAdminController::class)->names('categories');

    Route::get('/orders', [OrderAdminController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/status', [OrderAdminController::class, 'updateStatus'])->name('orders.status');

    Route::get('/customers', [CustomerAdminController::class, 'index'])->name('customers.index');
    Route::get('/customers/{user}', [CustomerAdminController::class, 'show'])->name('customers.show');
    Route::patch('/customers/{user}/toggle-block', [CustomerAdminController::class, 'toggleBlock'])->name('customers.toggle-block');

    Route::get('/reports', [ReportAdminController::class, 'index'])->name('reports.index');
    Route::get('/orders/{order}/invoice', [OrderAdminController::class, 'invoice'])->name('orders.invoice');

    Route::resource('coupons', CouponAdminController::class)->except(['show']);
    Route::get('/reviews', [ReviewAdminController::class, 'index'])->name('reviews.index');
    Route::delete('/reviews/{review}', [ReviewAdminController::class, 'destroy'])->name('reviews.destroy');

    Route::get('/settings', [\App\Http\Controllers\Admin\SettingAdminController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingAdminController::class, 'update'])->name('settings.update');
});

require __DIR__.'/auth.php';