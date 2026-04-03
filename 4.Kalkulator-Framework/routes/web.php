<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalcController;

Route::get('/', [CalcController::class, 'index']);

Route::post('/calc', [CalcController::class, 'compute']);