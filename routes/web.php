<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\RedirectIfGuest;

Route::get('/', function () {
    return view('index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.home');
    })->name('dashboard');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('admin.home');
});

Route::get('/shop', [ShopController::class, 'index'])->name('shop')->middleware(RedirectIfGuest::class);
Route::get('/contact', [ContactController::class, 'index'])->name('contact')->middleware(RedirectIfGuest::class);
Route::get('/cart', [CartController::class, 'index'])->name('cart')->middleware(RedirectIfGuest::class);
Route::get('/detail', [DetailController::class, 'index'])->name('detail')->middleware(RedirectIfGuest::class);
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout')->middleware(RedirectIfGuest::class);

Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.delete');

Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
Route::get('/admin/category', [CategoryController::class, 'ss'])->name('admin.category.ss');
Route::delete('/admin/category/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('admin.categories.delete');
Route::put('/admin/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

Route::get('/products', [ProductController::class, 'index'])->name('admin.product');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::put('/admin/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::get('/admin/manage-product/search', [ProductController::class, 'search'])->name('product.search');

Route::get('/', [ProductController::class, 'guestindex'])->name('products.index');