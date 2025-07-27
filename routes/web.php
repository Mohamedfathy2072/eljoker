<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     dd("Welcome to the API! Please use the /api endpoint for API requests.");
//     // return view('welcome');
// });

// Route::middleware('auth:web')->group(function () {
//     Route::get('/admin', [DashboardController::class, 'index']);
// });

// Route::post('/login', [AuthController::class, 'login'])->name('login');
// Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::prefix('admin')->group(function () {

    // register admin routes here
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/register', [AuthController::class, 'register'])->name('admin.submit.register');

    // login route
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.submit.login');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::prefix('brands')->group(function () {
            Route::get('/', [BrandController::class, 'showBrands'])->name('admin.brands');
            Route::post('/', [BrandController::class, 'storeBrand'])->name('admin.brands.store');
            Route::put('/{id}', [BrandController::class, 'editBrand'])->name('admin.brands.edit');
            Route::delete('/{id}', [BrandController::class, 'destroyBrand'])->name('admin.brands.destroy');
        });

        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    });
});

