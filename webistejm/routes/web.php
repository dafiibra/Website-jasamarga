<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValidationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('validation', [ValidationController::class,'show']);