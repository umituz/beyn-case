<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cache', function () {

    $users = \App\Models\Order::get();

    return view('welcome');
});

