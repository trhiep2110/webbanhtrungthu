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

// ===== ÁP DỤNG CHO TẤT CẢ ROUTE =====
Route::middleware('check.locked')->group(function () {

    // ===== CLIENT - KHÔNG CẦN ĐĂNG NHẬP =====
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/san-pham', [ProductController::class, 'index']);
    Route::get('/san-pham/{id}', [ProductController::class, 'show']);
    Route::get('/gioi-thieu', [PageController::class, 'about']);
    Route::get('/lien-he', [PageController::class, 'contact']);
    Route::post('/lien-he', [PageController::class, 'contactStore']);

    // ===== AUTH - KHÔNG CẦN ĐĂNG NHẬP =====
    Route::get('/dang-nhap', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/dang-nhap', [AuthController::class, 'login']);
    Route::get('/dang-ky', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/dang-ky', [AuthController::class, 'register']);
    Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('logout');
    Route::post('/dang-nhap-google', [AuthController::class, 'loginGoogle']);

    Route::get('/quen-mat-khau', [AuthController::class, 'forgotForm'])->name('password.request');
    Route::post('/quen-mat-khau', [AuthController::class, 'forgotPassword']);
    Route::get('/dat-lai-mat-khau', [AuthController::class, 'resetForm']);
    Route::post('/dat-lai-mat-khau', [AuthController::class, 'resetPassword']);
    Route::post('/gui-lai-otp', [AuthController::class, 'resendOtp']);

    // ===== ADMIN - CẦN LÀ ADMIN =====
    Route::prefix('admin')->middleware('check.admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('/san-pham', [AdminProductController::class, 'index']);
        Route::get('/don-hang', [AdminOrderController::class, 'index']);
        Route::get('/nguoi-dung', [AdminUserController::class, 'index']);
    });
});

// ===== CLIENT - CẦN ĐĂNG NHẬP =====
Route::middleware('check.auth')->group(function () {
    Route::get('/gio-hang', [CartController::class, 'index'])->name('gio-hang');
    Route::get('/thanh-toan', [CartController::class, 'checkout']);

    // Profile (gộp tab)
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile/cap-nhat', [ProfileController::class, 'updateProfile']);
    Route::post('/profile/doi-mat-khau', [ProfileController::class, 'changePassword']);
    Route::post('/profile/avatar', [ProfileController::class, 'uploadAvatar']);
    Route::delete('/profile/yeu-thich/{id}', [ProfileController::class, 'removeFavorite']);
    Route::post('/profile/dia-chi', [ProfileController::class, 'storeAddress']);
    Route::delete('/profile/dia-chi/{id}', [ProfileController::class, 'deleteAddress']);
});
