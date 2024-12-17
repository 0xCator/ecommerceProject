<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
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
            // Admin Dashboard Route
        Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Category Management Routes
        Route::match(['get', 'post'], 'admin/product', [ProductController::class, 'store'])->name('admin.products.add-product');
        // Route to display the edit form
        Route::get('admin/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');

        // Route to handle the update operation
        Route::put('admin/products/edit/{id}', [ProductController::class, 'update']);

        // Delete product route
        Route::delete('admin/products/delete/{id}', [ProductController::class, 'destroy'])->name('admin.products.delete');
        
        // Category Management Routes
        Route::match(['get', 'post'], 'admin/category/create', [CategoryController::class, 'store'])->name('admin.categories.create');
        Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('admin/category/edit/{id}', [CategoryController::class, 'update']);
        Route::delete('admin/category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');
    });
});

// Authentication Routes
require __DIR__ . '/auth.php';
