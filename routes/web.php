<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserCategoriesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\NewsletterSubscriberController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StripeController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware('block.admin')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('homepage.index');
    Route::get('/home', [HomeController::class, 'home'])->name('index.home');
    Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
    Route::get('/Cartview', [HomeController::class, 'Cartview'])->name('Cartview');

    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])
        ->name('newsletter.subscribe');

    Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->middleware('auth')->name('checkout.store');
    Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
    Route::get('/live-search', [ProductController::class, 'liveSearch'])->name('live.search');
    // web.php
    Route::post('/cart/add', [HomeController::class, 'add'])->name('cart.add');
    Route::post('/cart/addto', [HomeController::class, 'addto'])->name('cart.addto');
    Route::post('/cart/quantity', [HomeController::class, 'quantity'])->name('cart.quantity');
    Route::post('/cart/remove', [HomeController::class, 'remove'])->name('cart.remove');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return auth()->user()->role === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('user.dashboard');
        })->name('dashboard');
        Route::middleware(['auth', 'user'])->group(function () {
            Route::get('/user/dashboard', [HomeController::class, 'userDashboard'])->name('user.dashboard');
            Route::get('/orders/history', [HomeController::class, 'userDashboard'])->name('orders.history');
        });
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/orders/success/{order}', [CheckoutController::class, 'success'])->name('orders.success');

        Route::get('stripe', [StripeController::class, 'index']);
        Route::post('stripe/create-charge', [StripeController::class, 'createCharge'])->name('stripe.create-charge');
    });
});
// Admin Panel
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/admin/categories/index', [UserCategoriesController::class, 'index'])
        ->name('categories.index');
    Route::post('/admin/categories', [UserCategoriesController::class, 'store'])
        ->name('categories.store');

    Route::get('/categories/{id}/edit', [UserCategoriesController::class, 'edit'])
        ->name('categories.edit');

    Route::put('/categories/{id}', [UserCategoriesController::class, 'update'])
        ->name('categories.update');
    Route::delete('/categories/{id}', [UserCategoriesController::class, 'destroy'])
        ->name('categories.destroy');
    //products list
    Route::get('/admin/products/index', [ProductController::class, 'index'])
        ->name('admin.products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])
        ->name('admin.products.create');

    Route::post('/admin/products', [ProductController::class, 'store'])
        ->name('products.store');
    Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])
        ->name('admin.products.edit');
    Route::put('/admin/products/{id}', [ProductController::class, 'update'])
        ->name('admin.products.update');
    Route::delete('admin/products/{id}', [ProductController::class, 'destroy'])
        ->name('admin.products.destroy');

    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::patch('/admin/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.status');
    Route::get('admin/orders/success/{order}', [AdminOrderController::class, 'orderSuccess'])->name('admin.orders.success');

    Route::get('user/orders', [AdminOrderController::class, 'Userindex'])->name('user.orders.index');

    Route::get('/admin/newsletters', [NewsletterSubscriberController::class, 'index'])
        ->name('admin.newsletters.index');
    Route::get('/admin/contacts', [ContactMessageController::class, 'index'])
        ->name('admin.contacts.index');

    Route::get('/admin/debug/stripe-key', function () {
        $key = (string) config('services.stripe.key');
        $masked = $key ? substr($key, 0, 7) . str_repeat('*', max(0, strlen($key) - 11)) . substr($key, -4) : '';

        return response()->json([
            'stripe_key_loaded' => (bool) $key,
            'stripe_key_preview' => $masked,
            'stripe_currency' => config('services.stripe.currency', 'usd'),
        ]);
    })->name('admin.debug.stripe-key');

});
require __DIR__ . '/auth.php';
