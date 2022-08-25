<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CarsController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\ServicesController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

    Route::prefix('v1')->group(function () {
        Route::get('users', [UsersController::class, 'index']);
        Route::get('users/add-balance', [UsersController::class, 'addBalance']);
        Route::get('cars', [CarsController::class, 'index']);
        Route::get('services', [ServicesController::class, 'index']);
        Route::get('orders', [OrdersController::class, 'index']);
        Route::post('orders', [OrdersController::class, 'store']);
    });
});
