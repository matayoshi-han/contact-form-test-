<?php

use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;


Route::get('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/', [ContactController::class, 'store']);
Route::get('/', [CategoryController::class, 'index']);
Route::post('/', [CategoryController::class, 'store']);
Route::post('/register',[AdminUserController::class, 'register']);