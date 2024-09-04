<?php

use App\Http\Controllers\UserAdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/admin')->group(function () {
    Route::controller(UserAdminController::class)->group(function () {
        Route::post('/register', "register");
    });
    Route::controller(UserAdminController::class)->group(function () {
        Route::post('/login', "login");
    });
});

Route::get("/teste", function() {
    return ['funcionou!'];
})->middleware('auth:sanctum');
