<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Car\CarsGatewayController;
use App\Http\Controllers\Api\Order\OrdersGatewayController;
use App\Http\Controllers\Api\Service\ServicesGatewayController;
use App\Http\Controllers\Api\UsersController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

    Route::lapiv(function () {
        Route::get('cars', [CarsGatewayController::class, 'index']);
        Route::get('orders', [OrdersGatewayController::class, 'index']);
        Route::post('orders', [OrdersGatewayController::class, 'store']);
        Route::get('services', [ServicesGatewayController::class, 'index']);
    });

    Route::prefix('v1')->group(function () {
        Route::get('users', [UsersController::class, 'index']);
        Route::post('users/add-balance', [UsersController::class, 'addBalance']);
    });
});
