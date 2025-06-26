<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RoleController::class, 'index']);


Route::get('/category', [CategoryController::class, 'index']);
