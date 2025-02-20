<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductsController;

// Halaman login (hanya untuk tamu yang belum login)
Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginAuth'])->name('login.auth');
});

Route::get('/error-permission', function() {
    return view('errors.permission');
})->name('error.permission');

// Grup middleware untuk halaman yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    // Halaman utama (dashboard)
    Route::get('/dashboard', [PagesController::class, 'dashboard'])->name('dashboard');
    // Produk
    Route::middleware(['mustAdmin'])->group(function () {
        Route::prefix('/produk')->name('product.')->group(function () {
            Route::get('/', [ProductsController::class, 'index'])->name('index');
            Route::get('/add', [ProductsController::class, 'create'])->name('create');
            Route::post('/store', [ProductsController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ProductsController::class, 'edit'])->name('edit');
            Route::patch('/{id}/update', [ProductsController::class, 'update'])->name('update');
            Route::patch('/{id}/updatestock', [ProductsController::class, 'updatedstock'])->name('updatestock');
            Route::delete('/{id}', [ProductsController::class, 'destroy'])->name('delete');
        });
    
        Route::get('/pembelian', [PagesController::class, 'pembelian'])->name('pembelian');
        
        Route::prefix('/user')->name('user.')->group(function () {
            Route::get('/', [UsersController::class, 'index'])->name('index');
            Route::get('/add', [UsersController::class, 'create'])->name('create');
            Route::post('/store', [UsersController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('edit');
            Route::patch('/{id}/update', [UsersController::class, 'update'])->name('update');
            Route::delete('/{id}', [UsersController::class, 'destroy'])->name('delete');
        });
    
    });

    Route::middleware(['mustEmployee'])->group(function () {
        Route::get('/dashboard', [PagesController::class, 'e_dashboard'])->name('dashboard');
        Route::get('product', [ProductsController::class, 'e_index'])->name('product');

        Route::prefix('/sale')->name('sale.')->group(function () {
            Route::get('/', [SalesController::class, 'index'])->name('index');
        });
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});