<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Car\CarsGatewayController;
use App\Http\Controllers\Api\Order\OrdersGatewayController;
use App\Http\Controllers\Api\Service\ServicesGatewayController;
use App\Http\Controllers\Api\User\UsersGatewayController;
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
        Route::get('users', [UsersGatewayController::class, 'index']);
        Route::put('users/add-balance', [UsersGatewayController::class, 'addBalance']);
    });
});
