<?php
use Illuminate\Support\Facades\Route;
use App\Enums\RefurbishmentStatus;

use App\Http\Controllers\{
    AuthController,
    CarController,
    CalculatorController,
    BookController,
    QuizController,
    QuizAnswerController,
    QuizMatchController,
    StartAdController,
    FinancingRequestController,
    NotificationController as ApiNotificationController
};
use App\Http\Controllers\Admin\{
    BannerController,
    BrandController,
    BodyStyleController,
    CarModelController,
    DriveTypeController,
    EngineTypeController,
    TransmissionTypeController,
    TrimController,
    TypeController,
    VehicleStatusController
};

use App\Http\Controllers\Draftech\{
    AuthController as draftechAuthController,
    FavouriteController
};

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', config('app.app') === 'kalksat'
        ? [AuthController::class, 'login']
        : [draftechAuthController::class, 'login']
    );
    Route::post('/verifyOtp', [AuthController::class, 'verifyOtp']);
    Route::post('/resendOtp', [AuthController::class, 'resendOtp']);
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::get('/me', config('app.app') === 'kalksat'
        ? [AuthController::class, 'me']
        : [draftechAuthController::class, 'me']
    )->middleware('auth:api');
    Route::post('/updateProfile', [AuthController::class, 'updateProfile'])->middleware('auth:api');
    Route::get('/refreshToken', [AuthController::class, 'refershToken'])->middleware('auth:api');
    Route::delete('/deleteAccount', [AuthController::class, 'deleteAccount'])->middleware('auth:api');

    // draftech endpoints apis
    Route::post('send-otp', [draftechAuthController::class, 'sendOtp']);
    Route::post('verify-otp', [draftechAuthController::class, 'verifyOtp']);
    Route::post('update-profile', [draftechAuthController::class, 'updateProfile'])->middleware('auth:api');
    Route::post('update-password', [draftechAuthController::class, 'updatePassword'])->middleware('auth:api');
    Route::post('logout', [draftechAuthController::class, 'logout'])->middleware('auth:api');
    Route::delete('delete-account', [draftechAuthController::class, 'deleteAccount'])->middleware('auth:api');
    Route::post('/update-phone', [draftechAuthController::class, 'updatephone']);
    Route::post('/favourites/toggle/{carId}', [FavouriteController::class, 'toggleFavourite'])->middleware('auth:api');
    Route::get('/favourites', [FavouriteController::class, 'myFavourites'])->middleware('auth:api');
});

Route::prefix('financing-requests')->middleware('auth:api')->group(function () {
    Route::post('/', [FinancingRequestController::class, 'store']);
    Route::get('/', [FinancingRequestController::class, 'index']);
    Route::post('/cancel', [FinancingRequestController::class, 'cancel']);
});

Route::get('notifications/user', [ApiNotificationController::class, 'getForUser'])->middleware('auth:api');

Route::prefix('cars')->group(function () {
    Route::get('/', [CarController::class, 'all']);
    Route::post('/pagination/{sort_direction?}/{sort_by?}/{page?}/{per_page?}', [CarController::class, 'pagination']);
    Route::get('/{id}', [CarController::class, 'findById']);
    Route::middleware('auth:api')->group(function () {
        Route::post('/', [CarController::class, 'store']);
        Route::put('/{id}', [CarController::class, 'update']);
        Route::post('/my-cars/{sort_direction?}/{sort_by?}/{page?}/{per_page?}', [CarController::class, 'myCars']);
    });
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
    Route::post('/', [CarModelController::class, 'getModelsBrandAPI']);
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

Route::prefix('refurbishment_statuses')->group(function () {
    Route::get('/', function () {
        return response()->json([
            'data' => RefurbishmentStatus::cases()
        ]);
    });
    Route::get('/{id}', [VehicleStatusController::class, 'showAPI']);
});

Route::prefix('banners')->group(function () {
    Route::get('/', [BannerController::class, 'index']);
    Route::get('/{id}', [BannerController::class, 'show']);
});

Route::prefix('calculator')->group(function () {
    Route::post('/car-installment', [CalculatorController::class, 'calculateInstallment']);
    Route::post('/car-price', [CalculatorController::class, 'calculateCarPrice']);
});

Route::prefix('book')->middleware('auth:api')->group(function () {
    Route::post('/', [BookController::class, 'makeAppointment']);
    Route::get('/getBookedCars', [BookController::class, 'getBookedCars']);
});

Route::prefix('quizzes')->middleware('auth:api')->group(function () {
    Route::get('/', [QuizController::class, 'index']);
    Route::post('/answers', [QuizAnswerController::class, 'store']);
    Route::get('/match', [QuizMatchController::class, 'match']);
});

Route::prefix('start-ad')->group(function () {
    Route::get('/', [StartAdController::class, 'show']);
});

// draftech endpoints part 2
Route::post('complete-profile', [draftechAuthController::class, 'completeRegistration']);
Route::post('reset-password', [draftechAuthController::class, 'resetPassword'])->middleware('auth:api');



