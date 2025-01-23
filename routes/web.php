<?php

use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/testapi', function () {
//     return response()->json(['test' => 'oke']);
// });

// Route::get('/', [LoginController::class, 'show'])->name('login_page');
// Route::get('/login', [LoginController::class, 'show'])->name('login');
// Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', [MonitoringController::class, 'show'])->name('home');
Route::get('/data_monitoring', [MonitoringController::class, 'api_show'])->name('data_monitoring');
// Route::post('/monitoring', [MonitoringController::class, 'insert'])->name('post_monitoring');
