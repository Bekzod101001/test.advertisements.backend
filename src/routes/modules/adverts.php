<?php

use App\Http\Controllers\AdvertController;

Route::get('adverts', [AdvertController::class, 'index']);
Route::get('adverts/{advert}', [AdvertController::class, 'show']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('adverts', [AdvertController::class, 'store']);
    Route::put('adverts/{advert}', [AdvertController::class, 'update']);
    Route::delete('adverts/{advert}', [AdvertController::class, 'destroy']);
});
