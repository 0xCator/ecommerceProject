<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard for Authenticated Users
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Group Routes Requiring Authentication
Route::middleware('auth')->group(function () {
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Dashboard
    Route::middleware(CheckRole::class . ':user')->group(function () {

        Route::middleware(CheckRole::class . ':user')->group(function () {
            // User Dashboard
            Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

            // Add to Cart
            Route::post('/add-to-cart', [UserController::class, 'addToCart'])->name('user.add_to_cart');

            Route::get('/user/cart', [UserController::class, 'displayCart'])->name('cart.panel');
            Route::get('/user/orders', [UserController::class, 'displayOrders'])->name('order.panel');

            Route::post('/user/cart/update/{id}', [CartController::class, 'update'])->name('user.cart.update');
            Route::post('/user/cart/remove/{id}', [CartController::class, 'remove'])->name('user.cart.remove');
            Route::post('/user/cart/place-order', [CartController::class, 'placeOrder'])->name('user.cart.place-order');

        });

    });


    Route::middleware(CheckRole::class . ':admin')->group(function () {
        Route::resource('admin/products', ProductController::class);
        Route::resource('admin/categories', CategoryController::class);
        Route::get('/admin/orders', [OrderController::class, 'displayAllOrders'])->name('admin.orders');
    });
});

// Authentication Routes
require __DIR__ . '/auth.php';
