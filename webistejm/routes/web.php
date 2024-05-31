<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome')->name("home");
});

//Login Route
Route::get('/login', [AuthController::class, "Login"])->name("login");
Route::post('/login', [AuthController::class,"LoginPost"])->name("login.post");

//Register Route
Route::get('/register', [AuthController::class, "register"])->name("register");
Route::post('/register', [AuthController::class,"RegisterPost"])->name("register.post");

//Validation Route
Route::get('validation', [ValidationController::class,'show']);

