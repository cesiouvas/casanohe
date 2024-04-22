<?php

namespace App\Http\Controllers;

use App\Models\CustomOrder;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;

class customController extends Controller
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
    public function create($id)
    {
        $product = Products::leftJoin('types', 'types.id', '=', 'products.type_id')
            ->findOrFail($id);

        $users = User::all();

        return view('custom.create', compact('product', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'desc' => 'required',
            'type' => 'required',
            'subtype' => 'required',
            'comments' => 'required',
            'user' => 'required',
            'quantity' => 'required',
        ]);

        // guardamos el producto normal
        CustomOrder::create([
            'name' => $request->name,
            'price' => $request->price,
            'desc' => $request->desc,
            'type_id' => $request->type,
            'subtype' => $request->subtype,
            'comments' => $request->comments,
            'user_id' => $request->user,
            'quantity' => $request->quantity,
            'status' => 0
        ]);

        return redirect()->route('custom.index')
            ->with('success', 'Producto personalizado con éxito');
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
