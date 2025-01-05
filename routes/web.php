<?php

use App\Http\Controllers\MonitoringController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/testapi', function () {
//     return response()->json(['test' => 'oke']);
// });

Route::get('/', [MonitoringController::class, 'show'])->name('get_monitoring');
Route::get('/data_monitoring', [MonitoringController::class, 'api_show'])->name('data_monitoring');
// Route::post('/monitoring', [MonitoringController::class, 'insert'])->name('post_monitoring');