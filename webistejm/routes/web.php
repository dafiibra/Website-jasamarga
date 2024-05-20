<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('validation', [ValidationController::class,'show']);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::post('/upload', [DashboardController::class, 'store']);
#Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index'); ini masih perlu diperbaiki
