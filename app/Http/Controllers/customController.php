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
        $custom = CustomOrder::join("products", "products.id", "=", "custom_orders.product_id")
            ->select('custom_orders.*', 'products.name')
            ->get();

        return view('custom.index', compact('custom'));
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
            'product' => 'required',
            'comments' => 'required',
            'user' => 'required',
            'quantity' => 'required',
        ]);

        // guardamos el producto normal
        CustomOrder::create([
            'product_id' => $request->product,
            'comments' => $request->comments,
            'user_id' => $request->user,
            'quantity' => $request->quantity,
            'price' => 0,
            'admin_msg' => '',
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

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $custom = CustomOrder::leftJoin('users', 'users.id', '=', 'custom_orders.user_id')
            ->findOrFail($id);

        // return to the edit view
        return view('custom.edit', compact('custom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'price' => 'required',
            'comments' => 'required',
            'status' => 'required',
            'quantity' => 'required',
            'admin_msg' => 'required'
        ]);

        // seleccionar el custom order
        $co = CustomOrder::findOrFail($id);

        // update de los datos
        $co->update([
            'price' => $request->price,
            'comments' => $request->comments,
            'status' => $request->status,
            'quantity' => $request->quantity,
            'admin_msg' => $request->admin_msg,
        ]);

        $co->save();

        return redirect()->route('custom.index')
            ->with('success', 'custom order updated!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $co = CustomOrder::findOrFail($id);

        $co->delete();

        return redirect()->route('custom.index')
            ->with('success', 'custom order deleted!!');
    }
}
