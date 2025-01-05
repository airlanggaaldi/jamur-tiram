<?php

use App\Http\Controllers\MonitoringController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/monitoring', [MonitoringController::class, 'api_show'])->name('api_get_monitoring');
Route::post('/monitoring', [MonitoringController::class, 'insert'])->name('api_post_monitoring');