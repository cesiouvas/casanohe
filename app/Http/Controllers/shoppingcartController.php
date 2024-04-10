<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Http\Request;

class shoppingcartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sc = ShoppingCart::get();

        return view('shoppingCart.index', compact('sc'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($userId)
    {
        $products = Products::get();

        $user = User::findOrFail($userId);

        // return to the create view
        return view('shoppingCart.create', compact('products', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //dd($request);
        $request->validate([
            'quantity' => 'required',
            'user_id' => 'required',
            'product_id' => 'required'
        ]);
  
        ShoppingCart::create([
            'quantity'=>$request->quantity,
            'user_id'=>$request->user_id,
            'product_id'=>$request->product_id,
        ]);

        return redirect()->route('shoppingCart.show', ['userId' => $request->user_id])
            ->with('success', 'Producto añadido con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cart = ShoppingCart::leftJoin('products', 'products.id', '=', 'shoppingcart.product_id')
                    ->select('shoppingcart.quantity as quantity_line', 'shoppingcart.id as scid', 'shoppingcart.*', 'products.*')
                    ->where('user_id', '=', $id)
                    ->get();

        $user = User::findOrFail($id);

        //debug dd($userCart);  

        return view('shoppingCart.show', compact('cart', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // select all from table shoppingcart with an id
        $scline = ShoppingCart::findOrFail($id);

        $products = Products::get();

        // debug dd($user);

        // return to the edit view
        return view('shoppingCart.edit', compact('scline', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'quantity' => 'required',
            'product_id' => 'required'
        ]);

        $sc = ShoppingCart::findOrFail($id);
  
        $sc->update([
            'quantity'=>$request->quantity,
            'product_id'=>$request->product_id,
        ]);

        return redirect()->route('shoppingCart.show', ['userId' => $request->user_id])
            ->with('success', 'Producto editado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $sc = ShoppingCart::findOrFail($id);

        $sc->delete();

        return redirect()->route('shoppingCart.show', ['userId' => $sc->user_id])
            ->with('success', 'Línea eliminada con éxito');
    }
}
