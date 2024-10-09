<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// No middleware on the login route
Route::post('/login', [AuthController::class, 'login']);

// Register and other routes require authentication
Route::post('/register', [UserController::class, 'register'])->middleware('auth:sanctum');
Route::put('/edit/{id}', [UserController::class, 'edit'])->middleware('auth:sanctum');
Route::delete('/delete/{id}', [UserController::class, 'delete'])->middleware('auth:sanctum');
Route::get('/info', [UserController::class, 'info'])->middleware('auth:sanctum');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');