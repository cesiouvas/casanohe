<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ShoppingCart;
use App\Models\Users;
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
    public function create($id)
    {
        $products = Products::get();

        // return to the create view
        return view('shoppingCart.create', compact('products', $id));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userCart = Users::leftJoin('shoppingcart', 'users.id', '=', 'shoppingcart.user_id')
                    ->select('shoppingcart.*', 'users.*')
                    ->where('users.id', '=', $id)
                    ->get();

        //debug dd($sc);  

        return view('shoppingCart.show', compact('userCart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
