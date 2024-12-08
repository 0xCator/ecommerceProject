<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::middleware(CheckRole::class . ':user')->group(function () {
        // User Dashboard
        Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

        // Add to Cart
        Route::post('/add-to-cart', [UserController::class, 'addToCart'])->name('user.add_to_cart');

        Route::get('/user/cart', [UserController::class, 'displayCart'])->name('cart.dashboard');
        Route::post('/user/cart/update/{id}', [CartController::class, 'update'])->name('user.cart.update');
        Route::post('/user/cart/remove/{id}', [CartController::class, 'remove'])->name('user.cart.remove');
        Route::post('/user/cart/place-order', [CartController::class, 'placeOrder'])->name('user.cart.place-order');

        // Additional User Actions
        // Route::get('/user/orders', [UserController::class, 'displayOrders'])->name('user.display-orders');

        // User Orders
        Route::get('/user/orders', [UserController::class, 'orders'])->name('user.orders');
    });
});

require __DIR__.'/auth.php';
