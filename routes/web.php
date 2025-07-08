<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', [AuthController::class, 'loginPage'])->name('login.page');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register.page');

Route::group(['prefix' => 'panel-control'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/vehicles', [DashboardController::class, 'vahicles'])->name('vahicles');
    Route::get('/officers', [DashboardController::class, 'officers'])->name('officers');
    Route::get('/locations', [DashboardController::class, 'locations'])->name('locations');
});
