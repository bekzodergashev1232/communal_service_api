<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\WaterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

//Auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//get all users
Route::get('/users', [PublicController::class, 'getAllUsers']);

// Kommunal
Route::get('/users/{user_id}/communal', [PublicController::class, 'getCommunalMonthById']);
Route::get('/users/communal/all', [PublicController::class, 'getCommunalMonth']);

// Issiq suv & qarzdorlik
Route::post('issiq-suv', [WaterController::class, 'createIssiqSuv']);
Route::post('user-debt', [WaterController::class, 'createUserDebt']);
