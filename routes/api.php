<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EcoActionController;
use App\Http\Controllers\Api\EcoTipController;
use App\Http\Controllers\Api\UserProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

// Protected with Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Eco Actions (CRUD)
    Route::get('/eco-actions', [EcoActionController::class, 'index']);
    Route::post('/eco-actions', [EcoActionController::class, 'store']);
    Route::get('/eco-actions/{id}', [EcoActionController::class, 'show']);
    Route::put('/eco-actions/{id}', [EcoActionController::class, 'update']);
    Route::delete('/eco-actions/{id}', [EcoActionController::class, 'destroy']);
    Route::get('/eco-actions/stats/summary', [EcoActionController::class, 'summary']);

    // User profile
    Route::get('/user/profile', [UserProfileController::class, 'show']);
    Route::put('/user/profile', [UserProfileController::class, 'update']);

    // Eco tips
    Route::get('/eco-tips', [EcoTipController::class, 'index']);
    Route::get('/eco-tips/{id}', [EcoTipController::class, 'show']);
    Route::get('/eco-tips/category/{category}', [EcoTipController::class, 'byCategory']);
});
