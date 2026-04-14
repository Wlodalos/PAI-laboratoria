<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalcController;
use App\Http\Controllers\AuthController;

Route::get('/', [CalcController::class, 'index']);

Route::post('/calc', [CalcController::class, 'compute']);

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);