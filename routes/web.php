<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

// Welcome Page
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
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');

    // Admin Dashboard Route
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Category Management Routes
    Route::match(['get', 'post'], 'admin/product', [AdminController::class, 'addProduct'])->name('admin.products.add-product');
    // Route to display the edit form
    Route::get('admin/products/edit/{id}', [AdminController::class, 'editProduct'])->name('admin.products.edit');

    // Route to handle the update operation
    Route::put('admin/products/edit/{id}', [AdminController::class, 'updateProduct']);

    // Delete product route
    Route::delete('admin/products/delete/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
    
    // Category Management Routes
    Route::match(['get', 'post'], 'admin/category/create', [AdminController::class, 'createCategory'])->name('admin.categories.create');
    Route::get('admin/category/edit/{id}', [AdminController::class, 'editCategory'])->name('admin.categories.edit');
    Route::put('admin/category/edit/{id}', [AdminController::class, 'updateCategory']);
    Route::delete('admin/category/delete/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categories.delete');

});

// Authentication Routes
require __DIR__ . '/auth.php';
