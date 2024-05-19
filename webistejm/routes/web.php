<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, "Login"]);
Route::post('/login', [AuthController::class,"LoginPost"]);
Route::get('validation', [ValidationController::class,'show'])->name("login.post");