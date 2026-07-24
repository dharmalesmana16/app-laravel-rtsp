<?php

use App\Http\Controllers\DataCameraController;
use App\Http\Controllers\DataVendorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource("/vendor", DataVendorController::class);
Route::apiResource("/camera", DataCameraController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
