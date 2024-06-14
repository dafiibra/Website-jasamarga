<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;

// Route::middleware("auth")->group(function(){
//     Route::view("/","Welcome")->name("dashboard");
    
// });

// Route::get('validation', [ValidationController::class,'show']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name("dashboard")->middleware('check.session');
Route::post('/upload', [DashboardController::class, 'store'])->middleware('check.session');
Route::get('/dashboard/filter', [DashboardController::class, 'filterData'])->name('dashboard.filter')->middleware('check.session');


Route::get('validation', [ValidationController::class,'fetch_data'])->name('validation.fetch_data')->middleware('check.session');
Route::patch('validation/{id_deteksi}/approve', [ValidationController::class,'approveResult'])->middleware('check.session');
Route::patch('validation/{id_deteksi}/reject', [ValidationController::class,'rejectResult'])->middleware('check.session');

//Login Route
Route::get('/login', [AuthController::class, "Login"])->name("login");
Route::post('/login', [AuthController::class,"LoginPost"])->name("login.post");

//Register Route
Route::get('/register', [AuthController::class, "register"])->name("register");
Route::post('/register', [AuthController::class,"RegisterPost"])->name("register.post");

// logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('history', [HistoryController::class,'fetch_data'])->name('history.fetch_data')->middleware('check.session');
Route::post('history/update', [HistoryController::class, 'update'])->name('history.update')->middleware('check.session');
