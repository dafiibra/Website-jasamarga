<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome')->name("home");
});

// Route::get('validation', [ValidationController::class,'show']);
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::post('/upload', [DashboardController::class, 'store']);
#Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index'); ini masih perlu diperbaiki
Route::get('validation', [ValidationController::class,'fetch_data'])->name('validation.fetch_data');
Route::patch('validation/{id_deteksi}/approve', [ValidationController::class,'approveResult']);
Route::patch('validation/{id_deteksi}/reject', [ValidationController::class,'rejectResult']);
//Login Route
Route::get('/login', [AuthController::class, "Login"])->name("login");
Route::post('/login', [AuthController::class,"LoginPost"])->name("login.post");

//Register Route
Route::get('/register', [AuthController::class, "register"])->name("register");
Route::post('/register', [AuthController::class,"RegisterPost"])->name("register.post");