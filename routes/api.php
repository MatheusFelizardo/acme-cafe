<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;

Route::resource('users', UserController::class);
Route::post('users/authenticate', [UserController::class, 'login']);


