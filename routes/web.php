<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/user-dashboard', [UserController::class, 'index']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');

// Route Product
// Route::resource('/category', [CategoryController::class, 'indexx']); //Accessing to all method
Route::get('/category', [CategoryController::class, 'index']);
Route::post('/category', [CategoryController::class, 'store']);
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');


// Route Product
Route::get('/products', [ProductsController::class, 'index']);
Route::post('/products', [ProductsController::class, 'store']);
Route::put('/products/{product}', [ProductsController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');













