<?php

use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;

Route::resource('users', UserController::class);
Route::post('users/authenticate', [UserController::class, 'login']);

Route::get('dishes/categories', [DishController::class, 'categories']);
Route::post('dishes/{id}/category', [DishController::class, 'associate_category']);
Route::delete('dishes/{dishId}/category/{categoryId}', [DishController::class, 'remove_associated_category']);

Route::put('dishes/{id}/category', [DishController::class, 'edit_associated_category']);
Route::resource('dishes', DishController::class);

Route::get('vouchers', [VoucherController::class, 'index']);
Route::post('vouchers/generate', [VoucherController::class, 'generate']);
Route::post('voucher/{code}/associate/{userId}', [VoucherController::class, 'associate']);

Route::resource('orders', OrderController::class);