<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    dd("Welcome to the API! Please use the /api endpoint for API requests.");
    // return view('welcome');
});

Route::middleware('auth:web')->group(function () {
    Route::get('/admin', [DashboardController::class, 'index']);
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

