<?php

use App\Http\Controllers\DishController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::resource('users', UserController::class);
Route::post('users/authenticate', [UserController::class, 'login']);

Route::get('dishes/categories', [DishController::class, 'categories']);
Route::post('dishes/{id}/category', [DishController::class, 'associate_category']);
Route::delete('dishes/{dishId}/category/{categoryId}', [DishController::class, 'remove_associated_category']);

Route::put('dishes/{id}/category', [DishController::class, 'edit_associated_category']);
Route::resource('dishes', DishController::class);


