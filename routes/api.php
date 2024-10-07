<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\controllers\Controller;
use App\Http\Controllers\UserController;

Route::post('/register', [UserController::class, 'register']);
Route::put('/edit/{id}', [UserController::class, 'edit']);
Route::delete('/delete/{id}', [UserController::class, 'delete']);