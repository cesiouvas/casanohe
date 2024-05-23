<?php

use App\Http\Controllers\apiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

// usuarios
Route::get('users', [apiController::class, 'users']);

// login
Route::post('login', [apiController::class, 'login']);

// register
Route::post('register', [apiController::class, 'register']);

// get some dibujos & tejidos (index)
Route::get('getAllProducts', [apiController::class, 'getAllProducts']);

// get product details
Route::get('getProductDetails', [apiController::class, 'getProductDetails']);

Route::group(
    ["middleware" => ["auth:api"]],
    function () {
        // logout
        Route::get('logout', [apiController::class, 'logout']);

        // get user data
        Route::get('getUserData', [apiController::class, 'getUserData']);
        
        // actualizar datos de usuario
        Route::post('updateUserData', [ApiController::class, 'updateUserData']);

        // add product to cart
        Route::post('addProductToCart', [apiController::class, 'addProductToCart']);

        // get shopping cart
        Route::get('getProductsCarrito', [apiController::class, 'getProductsCarrito']);

        // actualizar carrito
        Route::put('actualizarCarrito', [apiController::class, 'actualizarCarrito']);

        // eliminar linea de carrito
        Route::delete('deleteCartLine', [apiController::class, 'deleteCartLine']);

        // procesar pedido
        Route::post('crearPedido', [apiController::class, 'crearPedido']);

        // get datos de usuario
        Route::post('getUserData', [apiController::class, 'getUserData']);

        // get pedidos de un usuario
        Route::get('getPedidosUsuario', [apiController::class, 'getPedidosUsuario']);

        // get lineas de un pedido
        Route::get('getLineasPedido', [apiController::class, 'getLineasPedido']);

        // get vista detallada de un pedido
        Route::get('getDetallePedido', [apiController::class, 'getDetallePedido']);

        // crear producto personalizado
        Route::post('createCustomOrder', [apiController::class, 'createCustomOrder']);

        // get pedidos personalizados
        Route::get('getCustomPedidosUsuario', [apiController::class, 'getCustomPedidosUsuario']);

        // get un pedido personalizado
        Route::get('getDetalleCustom', [apiController::class, 'getDetalleCustom']);

        // get un pedido personalizado
        Route::put('editarPedidoCustom', [apiController::class, 'editarPedidoCustom']);
    }
);
