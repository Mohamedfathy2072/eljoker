<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\Admin\{
    BrandController, BodyStyleController, CarModelController, DriveTypeController, EngineTypeController, TransmissionTypeController, TrimController, TypeController, VehicleStatusController
};
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

Route::prefix('brands')->group(function () {
    Route::get('/', [BrandController::class, 'indexAPI']);
    Route::get('/{id}', [BrandController::class, 'showAPI']);
});

Route::prefix('body_styles')->group(function () {
    Route::get('/', [BodyStyleController::class, 'indexAPI']);
    Route::get('/{id}', [BodyStyleController::class, 'showAPI']);
});
Route::prefix('models')->group(function () {
    Route::get('/', [CarModelController::class, 'indexAPI']);
    Route::get('/{id}', [CarModelController::class, 'showAPI']);
});

Route::prefix('drive_types')->group(function () {
    Route::get('/', [DriveTypeController::class, 'indexAPI']);
    Route::get('/{id}', [DriveTypeController::class, 'showAPI']);
});
Route::prefix('engine_types')->group(function () {
    Route::get('/', [EngineTypeController::class, 'indexAPI']);
    Route::get('/{id}', [EngineTypeController::class, 'showAPI']);
});

Route::prefix('transmission_types')->group(function () {
    Route::get('/', [TransmissionTypeController::class, 'indexAPI']);
    Route::get('/{id}', [TransmissionTypeController::class, 'showAPI']);
});

Route::prefix('trims')->group(function () {
    Route::get('/', [TrimController::class, 'indexAPI']);
    Route::get('/{id}', [TrimController::class, 'showAPI']);
});

Route::prefix('types')->group(function () {
    Route::get('/', [TypeController::class, 'indexAPI']);
    Route::get('/{id}', [TypeController::class, 'showAPI']);
});

Route::prefix('vehicle_statuses')->group(function () {
    Route::get('/', [VehicleStatusController::class, 'indexAPI']);
    Route::get('/{id}', [VehicleStatusController::class, 'showAPI']);
});
