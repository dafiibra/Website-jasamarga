<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgetPasswordManager;

Route::middleware("auth")->group(function(){
    Route::view("/","Welcome")->name("dashboard");
    
});



// Route::get('validation', [ValidationController::class,'show']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name("dashboard");
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

//Forget Password
Route::get('/forget-password', [ForgetPasswordManager::class, "forgetPassword"])->name("forget.password");
Route::post('/forget-password', [ForgetPasswordManager::class, "forgetPasswordPost"])->name("forget.password.post");
Route::get('/reset-password/{token}', [ForgetPasswordManager::class, "resetPassword"])->name("reset.password");
Route::post('/reset-password', [ForgetPasswordManager::class, "resetPasswordPost"])->name("reset.password.post");