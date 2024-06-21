<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgetPasswordManager;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UserManagementController;

Route::middleware("auth")->group(function(){
    Route::view("/","Welcome")->name("dashboard");
    
});

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

//Forget Password
Route::get('/forget-password', [ForgetPasswordManager::class, "forgetPassword"])->name("forget.password");
Route::post('/forget-password', [ForgetPasswordManager::class, "forgetPasswordPost"])->name("forget.password.post");
Route::get('/reset-password/{token}', [ForgetPasswordManager::class, "resetPassword"])->name("reset.password");
Route::post('/reset-password', [ForgetPasswordManager::class, "resetPasswordPost"])->name("reset.password.post");

// logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('history', [HistoryController::class,'fetch_data'])->name('history.fetch_data')->middleware('check.session');
Route::post('history/update', [HistoryController::class, 'update'])->name('history.update')->middleware('check.session');

Route::get('/user', [UserManagementController::class, 'index'])->name('user-management');
Route::get('/approve-user/{id}', [UserManagementController::class, 'approveUser'])->name('approve-user');
Route::get('/reject-user/{id}', [UserManagementController::class, 'rejectUser'])->name('reject-user');
Route::get('/view-user/{id}', [UserManagementController::class, 'viewUser'])->name('view-user');

Route::get('/user-data-json', [UserManagementController::class, 'getUserDataJson'])->name('user-data-json');