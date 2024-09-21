<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('admin.home');
});

// route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'redirect.user'])->group(function () {
//     Route::get('/user/home', [HomeController::class, 'index'])->name('user.home');
//     Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.home');
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
// Route::get('/user/home', [HomeController::class, 'index'])->name('user.home');
// Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.home');
// Route::get('/test', function () {
//     return 'Test Route';
// });