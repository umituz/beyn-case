<?php

use App\Http\Controllers\Api\Auth\AuthGatewayController;
use App\Http\Controllers\Api\Brand\BrandsGatewayController;
use App\Http\Controllers\Api\Car\CarsGatewayController;
use App\Http\Controllers\Api\Order\OrdersGatewayController;
use App\Http\Controllers\Api\Service\ServicesGatewayController;
use App\Http\Controllers\Api\User\UsersGatewayController;
use Illuminate\Support\Facades\Route;

Route::lapiv(function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', [AuthGateWayController::class, 'register']);
        Route::post('login', [AuthGateWayController::class, 'login']);
    });
});

Route::middleware('auth:sanctum')->group(function () {

    Route::lapiv(function () {

        Route::post('auth/logout', [AuthGateWayController::class, 'logout']);

        Route::resource('brands', BrandsGatewayController::class);
        Route::resource('cars', CarsGatewayController::class);
        Route::resource('services', ServicesGatewayController::class);
        Route::get('/filters', [OrdersGatewayController::class, 'filters']);
        Route::resource('orders', OrdersGatewayController::class);

        Route::group(['prefix' => 'account'], function () {
            Route::get('profile', [UsersGatewayController::class, 'profile']);
            Route::put('balance', [UsersGatewayController::class, 'balance']);
        });
    });
});
