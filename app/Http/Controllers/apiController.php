<?php

namespace App\Http\Controllers;

use App\Models\Products;
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
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $credenciales = request([
            'email','password'
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

    public function logout() {
        // borra el token
        auth()->user()->token()->revoke();

        return response()->json([
            "status" => true,
            "message" => "user logged out"
        ]);
    }

    // recoger pocos dibujos para el index
    public function getSomeDibujos() {
        $dibujos = Products::where('type_id', '=', 1)
            ->take(3)
            ->get();

        return response()->json([
            "data" => $dibujos,
        ]);
    }

    // recoger pocos tejidos para el index
    public function getSomeTejidos() {
        $tejidos = Products::where('type_id', '=', 2)
            ->take(3)
            ->get();

        return response()->json([
            "data" => $tejidos,
        ]);
    }
}
