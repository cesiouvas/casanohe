<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Http\Request;

class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($userId)
    {
        $user = User::findOrFail($userId);

        //$products = Products::get();

        $sc = ShoppingCart::select('shoppingcart.quantity as scquantity', 'products.*')
                            ->leftjoin('products', 'products.id', '=', 'shoppingcart.product_id')
                            ->where('user_id', $userId)
                            ->get();

        return view('order.create', compact('user', 'sc'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
