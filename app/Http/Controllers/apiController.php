<?php

namespace App\Http\Controllers;

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

    public function register(Request $request) {
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

    public function getProductDetails(Request $request) {
        $product = Products::findOrFail($request->product_id);

        return response()->json([
            "data" => $product,
        ]);
    }

    public function addProductToCart(Request $request) {
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
            $totalQuantity = $request->quantity + $sc->quantity;

            // se hace update a la línea del mismo producto
            $sc->update([
                'quantity' => $totalQuantity,
            ]);
        } else { // sino está en el carrito

            // guardamos el producto normal
            ShoppingCart::create([
                'quantity' => $request->quantity,
                'user_id' => $user->id,
                'product_id' => $request->product_id,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Product added!'
        ]);
    }
}
