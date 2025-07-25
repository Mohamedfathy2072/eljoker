<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/verifyOtp', [AuthController::class, 'verifyOtp']);
    Route::post('/resendOtp', [AuthController::class, 'resendOtp']);
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::get('/me', [AuthController::class, 'me'])->middleware('auth:api');
    Route::post('/updateProfile', [AuthController::class, 'updateProfile'])->middleware('auth:api');
    Route::get('/refreshToken', [AuthController::class, 'refershToken'])->middleware('auth:api');
});

Route::prefix('cars')->middleware('auth:api')->group(function () {
    Route::get('/', [CarController::class, 'all']);
    Route::post('/pagination/{sort_direction?}/{sort_by?}/{page?}/{per_page?}', [CarController::class, 'pagination']);
    Route::get('/{id}', [CarController::class, 'findById']);
    Route::post('/', [CarController::class, 'create']);
    Route::put('/{id}', [CarController::class, 'update']);
    Route::delete('/{id}', [CarController::class, 'delete']);
});
