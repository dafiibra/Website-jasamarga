<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgetPasswordManager;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\LogActivityController;


Route::middleware("auth")->group(function(){
    Route::view("/","Welcome")->name("dashboard");
});

//Dashboard
Route::middleware(['check.session'])->group(function () {
    //Log-activity
    Route::post('/log-activity', [LogActivityController::class, 'store'])->name('log.activity');

    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/filter', [DashboardController::class, 'filterData'])->name('dashboard.filter');

    //Validation
    Route::get('validation', [ValidationController::class,'fetch_data'])->name('validation.fetch_data');
    Route::patch('validation/{id_deteksi}/approve', [ValidationController::class,'approveResult']);
    Route::patch('validation/{id_deteksi}/reject', [ValidationController::class,'rejectResult']);

    //History
    Route::get('history', [HistoryController::class,'fetch_data'])->name('history.fetch_data');
    Route::post('history/update', [HistoryController::class, 'update'])->name('history.update');
});


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

Route::get('/user', [UserManagementController::class, 'index'])->name('user-management')->middleware('auth.admin');
Route::get('/approve-user/{id}', [UserManagementController::class, 'approveUser'])->name('approve-user')->middleware('auth.admin');
Route::get('/reject-user/{id}', [UserManagementController::class, 'rejectUser'])->name('reject-user')->middleware('auth.admin');
Route::get('/view-user/{id}', [UserManagementController::class, 'viewUser'])->name('view-user')->middleware('auth.admin');