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

Route::middleware(['auth:sanctum'])->get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/index/shop', [ShopController::class, 'products'])->name('shop')->middleware(RedirectIfGuest::class);
Route::get('/contact', [ContactController::class, 'index'])->name('contact')->middleware(RedirectIfGuest::class);
Route::get('/cart', [CartController::class, 'index'])->name('cart')->middleware(RedirectIfGuest::class);
Route::get('/detail', [DetailController::class, 'index'])->name('detail')->middleware(RedirectIfGuest::class);
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout')->middleware(RedirectIfGuest::class);

Route::get('/index', [ProductController::class, 'userindex'])->name('user.products.index');

Route::get('/admin', [AdminController::class, 'home'])->name('admin.home');
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
Route::get('/admin/users/search', [AdminController::class, 'search'])->name('users.search');
Route::get('/admin/users/sort', [AdminController::class, 'sort'])->name('users.sort');
Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.delete');

Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category');
Route::get('/admin/category/search', [CategoryController::class, 'search'])->name('category.search');
Route::get('/admin/category/sort', [CategoryController::class, 'sort'])->name('category.sort');
Route::delete('/admin/category/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');
Route::put('/admin/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
Route::post('/admin/categories', [CategoryController::class, 'store'])->name('categories.store');

Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.product');
Route::post('/admin/products', [ProductController::class, 'store'])->name('products.store');
Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::put('/admin/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::get('/admin/products/search', [ProductController::class, 'search'])->name('product.search');
Route::get('/admin/products/sort', [ProductController::class, 'sort'])->name('product.sort');

Route::get('/', [ProductController::class, 'guestindex'])->name('products.index');