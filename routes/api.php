<?php

use App\Http\Controllers\DishController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::resource('users', UserController::class);
Route::post('users/authenticate', [UserController::class, 'login']);

Route::resource('dishes', DishController::class);


