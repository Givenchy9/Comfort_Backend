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
Route::post('/basicregister', [UserController::class, 'basicRegister']);
Route::post('/completeregister', [UserController::class, 'completeRegister'])->middleware('auth:sanctum');
Route::put('/edituser/{id}', [UserController::class, 'edit'])->middleware('auth:sanctum');
Route::delete('/deleteuser/{id}', [UserController::class, 'delete'])->middleware('auth:sanctum');
Route::get('/allusers', [UserController::class, 'info'])->middleware('auth:sanctum');
Route::get('/userinfo/{id}', [UserController::class, 'show'])->middleware('auth:sanctum');

// Huis controller
Route::get('/huizen', [HuisController::class, 'huizen']);
Route::get('/huizen/{id}', [HuisController::class, 'show']);
Route::post('/create', [HuisController::class, 'create'])->middleware('auth:sanctum');
Route::put('/huizen/{id}', [HuisController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/delete/{id}', [HuisController::class, 'delete']);//->middleware('auth:sanctum');

// Routes for adding pictures
Route::post('/huizen/{id}/picture', [HuisController::class, 'createpicture']);//->middleware('auth:sanctum');
Route::post('/huizen/{id}/pictures', [HuisController::class, 'createpictures']);//->middleware('auth:sanctum');