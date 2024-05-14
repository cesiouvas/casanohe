<?php

use App\Http\Controllers\customController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\productsController;
use App\Http\Controllers\shoppingcartController;
use App\Http\Controllers\typesController;
use App\Http\Controllers\usersController;
use App\Http\Middleware\Authenticate;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ----- orders -----
Route::resource('orders', orderController::class);

Route::get('/orders', [orderController::class,'index'])->name('orders.index');

Route::get('/orders/create/{userId}', [orderController::class,'create'])->name('orders.create');

// ----- custom -----
Route::resource('custom', customController::class);

Route::get('/custom', [customController::class,'index'])->name('custom.index');

Route::get('/custom/create/{product}', [customController::class,'create'])->name('custom.create');



