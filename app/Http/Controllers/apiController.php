<?php

namespace App\Http\Controllers;

use App\Models\CustomOrder;
use App\Models\OrderProduct;
use App\Models\Orders;
use App\Models\Products;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class apiController extends Controller
{
    // get usuarios fetch a localhost/api/users
    public function users()
    {
        $users = User::get();

        return response()->json([
            "data" => $users,
        ]);
    }

    public function getUserData()
    {
        $user = Auth::user();

        return response()->json([
            "data" => $user,
        ]);
    }

    public function updateUserData(Request $request)
    {
        // validar datos
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'dni' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'cp' => 'required',
        ]);

        // obtener usuario a editar
        $user = Auth::user();

        // instanciar usuario como clase user
        $usuario = User::findOrFail($user->id);

        // actualizar datos
        $usuario->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'dni' => $request->dni,
            //'telephone' => $request->telephone,
            'country' => $request->country,
            'city' => $request->city,
            'address' => $request->address,
            'cp' => $request->cp,
        ]);

        return response()->json([
            "msg" => 'Datos de usuario actualizados correctamente',
        ]);
    }

    // login ususarios POST
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $credenciales = request([
            'email', 'password'
        ]);

        if (!Auth::attempt($credenciales)) {
            // Usuario no autorizado
            return response()->json([
                'msg' => 'No autorizado'
            ], 401);
        }

        $user = $request->user();

        $token_res = $user->createToken('token');

        // transformar en token al usuario
        $token = $token_res->token;

        // guardar en la base de datos
        $token->save();

        return response()->json([
            'accessToken' => $token_res->accessToken, // token de acceso
            'token_type' => 'Bearer' // tipo de token
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'passwd' => 'required|string|confirmed' // Este validador espera un campo 'passwd_confirmation'
        ]);

        // No es necesario validar 'passwd_confirmation' explícitamente, ya que el validador 'confirmed' se encarga de eso.

        $user = new User([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->passwd),
            'dni' => '',
            'type' => 1
        ]);

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User successfully created!'
        ]);
    }


    public function logout()
    {
        // borra el token
        auth()->user()->token()->revoke();

        return response()->json([
            "status" => true,
            "message" => "user logged out"
        ]);
    }

    // recoger pocos dibujos para el index
    public function getAllProducts(Request $request)
    {
        // declarar query de productos
        $products = Products::select('*');

        // si tiene tipo
        if (isset($request->type)) {
            // busca por tipo
            $products->where('type_id', $request->type);
        }

        // recoger solo unos pocos (index)
        if ($request->some == 1) {
            $products->take(3);
        }

        $result = $products->get();

        // devuelve datos al js
        return response()->json([
            "data" => $result,
        ]);
    }

    public function getProductDetails(Request $request)
    {
        $product = Products::findOrFail($request->product_id);

        return response()->json([
            "data" => $product,
        ]);
    }

    public function addProductToCart(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'quantity' => 'required',
            'product_id' => 'required'
        ]);

        // datos de carrito
        $sc = ShoppingCart::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->first();

        if (isset($sc)) { // tiene valor (hay una línea con el mismo producto)
            // sumamos cantidades
            $totalQuantity = $request->quantity + $sc->line_quantity;

            $prod = Products::findOrFail($sc->product_id);
            $totalPrice = $prod->price * $totalQuantity;

            // se hace update a la línea del mismo producto
            $sc->update([
                'line_quantity' => $totalQuantity,
                'line_price' => $totalPrice
            ]);
        } else { // sino está en el carrito
            $prod = Products::findOrFail($request->product_id);
            $totalPrice = $prod->price * $request->quantity;

            // guardamos el producto normal
            ShoppingCart::create([
                'line_quantity' => $request->quantity,
                'user_id' => $user->id,
                'product_id' => $request->product_id,
                'line_price' => $totalPrice
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Product added!'
        ]);
    }

    public function getProductsCarrito()
    {
        $user = Auth::user();

        $carrito = ShoppingCart::leftJoin('products', 'products.id', '=', 'shoppingcart.product_id')
            ->leftjoin('types', 'types.id', '=', 'products.type_id')
            ->select('shoppingcart.id as scid', 'shoppingcart.*', 'products.*', 'types.type')
            ->where('user_id', $user->id)
            ->get();

        return response()->json([
            "data" => $carrito,
        ]);
    }

    public function actualizarCarrito(Request $request)
    {
        $carritos = $request->cartIds;
        $cantidadLinea = $request->quantityLines;

        $user = Auth::user();

        for ($i = 0; $i < count($carritos); $i++) {
            $carrito = ShoppingCart::find($carritos[$i]);

            if ($carrito->line_quantity != $cantidadLinea[$i]) {
                $product = Products::find($carrito->product_id);

                $carrito->update([
                    'line_quantity' => $cantidadLinea[$i],
                    'line_price' => $product->price + $cantidadLinea[$i]
                ]);
            }
        }
        return response()->json([
            "data" => $carrito,
        ]);
    }

    public function deleteCartLine(Request $request)
    {
        $user = Auth::user();

        $idCart = $request->line;

        $sc = ShoppingCart::findOrFail($idCart);

        $sc->delete();

        return response()->json([
            "data" => $sc,
        ]);
    }

    public function crearPedido(Request $request)
    {
        $user = Auth::user();

        // Validación de datos
        $request->validate([
            'totalPrice' => 'required'
        ]);

        // Crear pedido
        Orders::create([
            'totalPrice' => $request->totalPrice,
            'user_id' => $user->id,
            'order_status' => 0
        ]);

        // Obtener el último pedido realizado por el usuario
        $lastOrder = Orders::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->first();

        // Obtener las líneas de pedido del carrito de compras
        $cartLines = ShoppingCart::where('user_id', $user->id)->get();

        // Procesar cada línea del carrito de compras
        foreach ($cartLines as $cartLine) {
            // Actualizar la cantidad de productos
            $product = Products::findOrFail($cartLine->product_id);
            $newQuantity = $product->quantity - $cartLine->line_quantity;

            $product->update([
                'quantity' => $newQuantity
            ]);

            // Crear línea de pedido
            OrderProduct::create([
                'quantity' => $cartLine->line_quantity,
                'product_id' => $cartLine->product_id,
                'order_id' => $lastOrder->id
            ]);
        }

        // Limpiar el carrito de compras después de completar el pedido
        ShoppingCart::where('user_id', $user->id)->delete();

        return response()->json([
            "msg" => "pedido realizado",
        ]);
    }

    public function getPedidosUsuario()
    {
        $user = Auth::user();

        $orders = Orders::where('user_id', '=', $user->id)
            ->get();

        return response()->json([
            "data" => $orders,
        ]);
    }

    public function getLineasPedido(Request $request)
    {
        $user = Auth::user();

        $orderLines = OrderProduct::where('order_product.order_id', $request->order_id)
            ->leftJoin('products', 'products.id', '=', 'order_product.product_id')
            ->select(
                'products.name as product_name', // Seleccionar campos de productos
                'products.*',
                'order_product.quantity as quantity_line',
            )
            ->get();

        return response()->json([
            "data" => $orderLines,
        ]);
    }

    public function getDetallePedido(Request $request)
    {
        $user = Auth::user();

        $order = Orders::findOrFail($request->order_id);

        return response()->json([
            "data" => $order,
        ]);
    }

    function createCustomOrder(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'product_id' => 'required',
            'comments' => 'required',
            'quantity' => 'required',
        ]);

        // guardamos el producto normal
        CustomOrder::create([
            'product_id' => $request->product_id,
            'comments' => $request->comments,
            'user_id' => $user->id,
            'quantity' => $request->quantity,
            'price' => 0,
            'admin_msg' => '',
            'status' => 0
        ]);

        return response()->json([
            "msg" => "custom enviado!!",
        ]);
    }
}
