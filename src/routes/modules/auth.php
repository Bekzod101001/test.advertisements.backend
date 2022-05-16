<?php

use App\Http\Controllers\AuthController;

Route::group(['prefix' => 'auth'], function(){
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => ['auth:sanctum']], function(){
        Route::get('me', [AuthController::class, 'getAuthUser']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});
