<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\PreventBackHistory;
use Illuminate\Support\Facades\Route;


//Public or Guests Routes
Route::middleware('guest')->group(function() {
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']); 
});

//Authenticated Users
Route::middleware(['auth', PreventBackHistory::class])->group(function () {
    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

    //User Dashboard
    Route::get('/user-dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::post('/user-dashboard', [UserController::class, 'store'])->name('orders.store');
});

//Super Admin and Admin Dashboard
Route::middleware(['auth', 'role:admin,super_admin'])->group(function() {
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');

    //Category
    Route::get('/category', [CategoryController::class, 'index']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

    //Product
    Route::get('/products', [ProductsController::class, 'index']);
    Route::post('/products', [ProductsController::class, 'store']);
    Route::put('/products/{product}', [ProductsController::class, 'update'])->name('products.update');

});

//Super Admibn only
Route::middleware(['auth', 'role:super_admin'])->group(function() {
    
    //Category
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    //Product
    Route::delete('/products/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');
}); 














