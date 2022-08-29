<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Car\CarsGatewayController;
use App\Http\Controllers\Api\Order\OrdersGatewayController;
use App\Http\Controllers\Api\Service\ServicesGatewayController;
use App\Http\Controllers\Api\User\UsersGatewayController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('auth/logout', [AuthController::class, 'logout']);

    Route::lapiv(function () {

        Route::group(['prefix' => 'cars'], function () {
            Route::get('/', [CarsGatewayController::class, 'index']);
            Route::get('/{id}', [CarsGatewayController::class, 'show']);
        });

        Route::group(['prefix' => 'services'], function () {
            Route::get('/', [ServicesGatewayController::class, 'index']);
            Route::get('/{id}', [ServicesGatewayController::class, 'show']);
        });

        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', [OrdersGatewayController::class, 'index']);
            Route::post('/', [OrdersGatewayController::class, 'store']);
            Route::get('/filters', [OrdersGatewayController::class, 'filters']);
            Route::get('/{id}', [OrdersGatewayController::class, 'show']);
        });

        Route::group(['prefix' => 'account'], function () {
            Route::get('profile', [UsersGatewayController::class, 'profile']);
            Route::put('balance', [UsersGatewayController::class, 'balance']);
        });
    });
});
