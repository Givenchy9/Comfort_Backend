<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HuisController;

// Auth controller
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// User controller
Route::post('/register', [UserController::class, 'register']);
Route::put('/edit/{id}', [UserController::class, 'edit'])->middleware('auth:sanctum');
Route::delete('/delete/{id}', [UserController::class, 'delete'])->middleware('auth:sanctum');
Route::get('/info', [UserController::class, 'info'])->middleware('auth:sanctum');
Route::get('/info/{id}', [UserController::class, 'show'])->middleware('auth:sanctum');

// Huis controller
Route::get('/huizen', [HuisController::class, 'huizen']);//->middleware('auth:sanctum');
Route::get('/huizen/{id}', [HuisController::class, 'show']);
Route::post('/create', [HuisController::class, 'create']);