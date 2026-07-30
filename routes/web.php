<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MatrixController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/vendor', fn () => view('datavendor.index'));
    Route::get('/vendor/create', fn () => view('datavendor.create'));
    Route::get('/vendor/{vendor}/edit', fn () => view('datavendor.edit'));
    Route::get('/camera', fn () => view('datacamera.index'));
    Route::get('/camera/create', fn () => view('datacamera.create'));
    Route::get('/camera/{camera}/edit', fn () => view('datacamera.edit'));

    Route::get('/pekerjaan', fn () => view('pekerjaan.index'));
    Route::get('/pekerjaan/create', fn () => view('pekerjaan.create'));
    Route::get('/pekerjaan/{pekerjaan}/edit', fn () => view('pekerjaan.edit'));

    Route::get('/kartu', fn () => view('datakartu.index'));
    Route::get('/kartu/create', fn () => view('datakartu.create'));
    Route::get('/kartu/{kartu}/edit', fn () => view('datakartu.edit'));

    Route::middleware('admin')->group(function () {
        Route::get('/user', fn () => view('user.index'));
        Route::get('/user/create', fn () => view('user.create'));
        Route::get('/user/{user}/edit', fn () => view('user.edit'));
    });

    Route::get('/matrix', [MatrixController::class, 'index']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
