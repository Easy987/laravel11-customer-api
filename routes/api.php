<?php

use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::apiResource('persons', PersonController::class);
});
