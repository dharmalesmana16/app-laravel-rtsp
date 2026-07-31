<?php

use App\Http\Controllers\DataCameraController;
use App\Http\Controllers\DataVendorController;
use App\Http\Controllers\InternalCameraController;
use App\Http\Controllers\KartuController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('/vendor', DataVendorController::class);
    Route::apiResource('/camera', DataCameraController::class);
    Route::apiResource('/pekerjaan', PekerjaanController::class);
    Route::apiResource('/kartu', KartuController::class);

    Route::middleware('admin')->group(function () {
        Route::apiResource('/user', UserController::class);
    });
});

Route::middleware('service.token')->prefix('internal')->group(function () {
    Route::get('/cameras', [InternalCameraController::class, 'index']);
    Route::get('/camera/{camera}', [InternalCameraController::class, 'show']);
    Route::get('/camera/{camera}/rtsp', [InternalCameraController::class, 'rtspUrl']);
    Route::post('/camera/{camera}/heartbeat', [InternalCameraController::class, 'heartbeat']);
});
