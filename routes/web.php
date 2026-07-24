<?php

use App\Http\Controllers\ProfileController;
use App\Models\DataCamera;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/vendor', function () {
    return view('datavendor.index');
});
Route::get('/vendor/create', function () {
    return view('datavendor.create');
});
Route::get('/camera', function () {
    return view('datacamera.index');
});
Route::get('/camera/create', function () {
    return view('datacamera.create');
});

Route::get('/matrix', function () {
    $model = new DataCamera();

    $data = [
        "res" => $model::all()
    ];
    // $data = [
    //     "res" => [
    //         [
    //             "username" => "admin",
    //             "password" => "x0121oke",
    //             "ip_address" => "116.66.205.182",
    //             "channel" => "10",
    //             "port" => 8010,
    //         ],
    //         [
    //             "username" => "admin",
    //             "password" => "x0121oke",
    //             "ip_address" => "116.66.205.182",
    //             "channel" => "11",
    //             "port" => 8011,
    //         ],
    //         [
    //             "username" => "admin",
    //             "password" => "x0121oke",
    //             "ip_address" => "116.66.205.182",
    //             "channel" => "12",
    //             "port" => 8012,
    //         ],
    //         [
    //             "username" => "admin",
    //             "password" => "x0121oke",
    //             "ip_address" => "116.66.205.182",
    //             "channel" => "13",
    //             "port" => 8013,
    //         ],
    //         [
    //             "username" => "admin",
    //             "password" => "x0121oke",
    //             "ip_address" => "116.66.205.182",
    //             "channel" => "14",
    //             "port" => 8014,
    //         ],
    //         [
    //             "username" => "admin",
    //             "password" => "x0121oke",
    //             "ip_address" => "116.66.205.182",
    //             "channel" => "15",
    //             "port" => 8015,
    //         ],
    //         [
    //             "username" => "admin",
    //             "password" => "x0121oke",
    //             "ip_address" => "116.66.205.182",
    //             "channel" => "16",
    //             "port" => 8016,
    //         ],
    //         [
    //             "username" => "admin",
    //             "password" => "x0121oke",
    //             "ip_address" => "116.66.205.182",
    //             "channel" => "19",
    //             "port" => 8019,
    //         ],
    //     ]
    // ];
    return view('matrix.index', $data);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
