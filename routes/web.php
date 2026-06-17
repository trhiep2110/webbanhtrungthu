<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\PageController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

// ===== CLIENT =====
Route::get('/', [HomeController::class, 'index']);
Route::get('/san-pham', [ProductController::class, 'index']);
Route::get('/san-pham/{id}', [ProductController::class, 'show']);
Route::get('/gio-hang', [CartController::class, 'index']);
Route::get('/thanh-toan', [CartController::class, 'checkout']);
Route::get('/gioi-thieu', [PageController::class, 'about']);
Route::get('/lien-he', [PageController::class, 'contact']);
Route::post('/lien-he', [PageController::class, 'contactStore']);
Route::get('/profile', [ProfileController::class, 'index']);
Route::get('/don-hang', [ProfileController::class, 'orders']);
Route::get('/yeu-thich', [ProfileController::class, 'favorites']);

// ===== AUTH =====
Route::get('/dang-nhap', [AuthController::class, 'loginForm'])->name('login');
Route::post('/dang-nhap', [AuthController::class, 'login']);
Route::get('/dang-ky', [AuthController::class, 'registerForm']);
Route::post('/dang-ky', [AuthController::class, 'register']);
Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('logout');
Route::post('/dang-nhap-google', [AuthController::class, 'loginGoogle']);
Route::get('/quen-mat-khau', [AuthController::class, 'forgotForm']);

// ===== ADMIN =====
Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/san-pham', [AdminProductController::class, 'index']);
    Route::get('/don-hang', [AdminOrderController::class, 'index']);
    Route::get('/nguoi-dung', [AdminUserController::class, 'index']);
});