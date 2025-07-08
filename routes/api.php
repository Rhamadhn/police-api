<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\LocationController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['prefix' => 'panel-control', 'middleware' => ['auth:sanctum']], function () {
    // Authenticated routes
    Route::get('/profile', [AuthController::class, 'profil']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Vehicle endpoints
    Route::get('/vehicles', [VehicleController::class, 'index']);
    Route::post('/vehicles', [VehicleController::class, 'store']);
    Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show']);
    Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update']);
    Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy']);

     // Officer endpoints
    Route::get('/officers', [OfficerController::class, 'index']);
    Route::post('/officers', [OfficerController::class, 'store']);
    Route::get('/officers/{officer}', [OfficerController::class, 'show']);
    Route::put('/officers/{officer}', [OfficerController::class, 'update']);
    Route::delete('/officers/{officer}', [OfficerController::class, 'destroy']);

    Route::apiResource('locations', LocationController::class);
});
