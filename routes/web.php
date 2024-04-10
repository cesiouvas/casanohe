<?php

use App\Http\Controllers\productsController;
use App\Http\Controllers\shoppingcartController;
use App\Http\Controllers\typesController;
use App\Http\Controllers\usersController;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ----- Users -----

Route::resource('users', usersController::class);

// en /users usa el controlador user y nos lleva a users/index
Route::get('/users', [usersController::class,'index'])->name('users.index');

// ----- types -----

Route::resource('types', typesController::class);

// en /types usa el typesController y nos lleva a types/index
Route::get('/types', [typesController::class,'index'])->name('types.index');

// ----- products -----

Route::resource('products', productsController::class);

// en /types usa el typesController y nos lleva a types/index
Route::get('/products', [productsController::class,'index'])->name('products.index');

// ----- shopping cart -----
Route::resource('shoppingCart', shoppingcartController::class);

Route::get('/shoppingCart/create/{userId}', [shoppingcartController::class,'create'])->name('shoppingCart.create');
Route::get('/shoppingCart/show/{userId}', [shoppingcartController::class,'show'])->name('shoppingCart.show');



