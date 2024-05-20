<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValidationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('validation', [ValidationController::class,'show']);
Route::post('validation/fetch_data', 'App\Http\Controllers\ValidationController@fetch_data')->name('validation.fetch_data');