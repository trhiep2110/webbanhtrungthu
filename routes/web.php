<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;

// ===== CLIENT ROUTES =====
Route::get('/', [HomeController::class, 'index']);



use App\Http\Controllers\Client\ProductController;

Route::get('/san-pham', [ProductController::class, 'index']);
Route::get('/san-pham/{id}', [ProductController::class, 'show']);



use App\Http\Controllers\Client\AuthController;

Route::get('/dang-nhap', [AuthController::class, 'loginForm']);
Route::get('/dang-ky', [AuthController::class, 'registerForm']);
Route::get('/quen-mat-khau', [AuthController::class, 'forgotForm']);


use App\Http\Controllers\Client\CartController;

Route::get('/gio-hang', [CartController::class, 'index']);
Route::get('/thanh-toan', [CartController::class, 'checkout']);


use App\Http\Controllers\Client\PageController;

Route::get('/gioi-thieu', [PageController::class, 'about']);
Route::get('/lien-he', [PageController::class, 'contact']);


use App\Http\Controllers\Client\ProfileController;

Route::get('/profile', [ProfileController::class, 'index']);
Route::get('/don-hang', [ProfileController::class, 'orders']);
Route::get('/yeu-thich', [ProfileController::class, 'favorites']);



use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/san-pham', [AdminProductController::class, 'index']);
    Route::get('/don-hang', [AdminOrderController::class, 'index']);
    Route::get('/nguoi-dung', [AdminUserController::class, 'index']);
});
