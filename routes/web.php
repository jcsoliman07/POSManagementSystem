<?php

use App\Http\Controllers\Category;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RoleController::class, 'index']);


Route::get('/category', [Category::class, 'index']);
