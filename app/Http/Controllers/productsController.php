<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Types;
use Illuminate\Http\Request;

class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::join("types", "types.id", "=", "products.type_id")
                                ->select("products.*", "types.type as type")                        
                                ->get();
        //dd($products);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /*
        $products = Products::select('products.*', 'types.*')
                    ->leftJoin('types', 'products.type_id', '=', 'types.id')
                    ->get();
        */

        $types = Types::get();

        //dd($products);

        return view('products.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate inputs
        $request->validate([
            'name'=>'required',
            'desc'=>'required',
            'image'=>'required',
            'type'=>'required',
            'subtype'=>'required',
            'quantity'=>'required',
            'price'=>'required',
        ]);

        //dd($request);


        Products::create([
            'name'=>$request->name,
            'desc'=>$request->desc,
            'image'=>$request->image,
            'type_id'=>$request->type,
            'subtype'=>$request->subtype,
            'quantity'=>$request->quantity,
            'price'=>$request->price,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'product created!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // select all from table users with an id
        $prod = Products::select('products.*')->findOrFail($id);
     
        // debug dd($user);

        // return to the show view
        return view('products.show', compact('prod'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // select all from table users with an id
        $prod = Products::select('products.*')->findOrFail($id);
     
        // debug dd($user);

        // return to the show view
        return view('products.edit', compact('prod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate inputs
        $request->validate([
            'name'=>'required',
            'desc'=>'required',
            'image'=>'required',
            'type'=>'required',
            'subtype'=>'required',
            'quantity'=>'required',
            'price'=>'required',
        ]);

        $prod = Products::findOrFail($id);

        //dd($request);

        $prod->update([
            'name'=>$request->name,
            'desc'=>$request->desc,
            'image'=>$request->image,
            'type_id'=>$request->type,
            'subtype'=>$request->subtype,
            'quantity'=>$request->quantity,
            'price'=>$request->price,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'product edited!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prod = Products::findOrFail($id);

        $prod->delete();

        return redirect()->route('products.index')
            ->with('success', 'produt deleted!!');
    }
}
