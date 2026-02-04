<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SaleController;

// กำหนดให้ URL `/` แสดงหน้า Login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route แสดงฟอร์ม Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Route ประมวลผลการเข้าสู่ระบบ
Route::post('/login', [LoginController::class, 'processLogin'])->name('login.process');

Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
Route::post('/sales/place-order', [SaleController::class, 'placeOrder'])->name('sales.placeOrder');
Route::get('/sales/history', [SaleController::class, 'history'])->name('sales.history');


Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::resource('products', ProductController::class);
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::post('/products/toggle-active', [ProductController::class, 'toggleActive'])->name('products.toggleActive');