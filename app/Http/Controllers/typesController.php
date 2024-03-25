<?php

namespace App\Http\Controllers;

use App\Models\Types;
use Illuminate\Http\Request;
use Mockery\Matcher\Type;

class typesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Types::get();
        
        //dd($types);

        return view('types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Types::get();

        return view('types.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //debug dd($request);

        // validate inputs
        $request->validate([
            'type'=>'required',
        ]);

        Types::create([
            'type'=>$request->type,
        ]);

        return redirect()->route('types.index')
            ->with('success', 'type created!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // select all from table types with an id
        $type = Types::select('types.*')->findOrFail($id);
     
        // debug dd($type);

        // return to the show view
        return view('types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // select all from table types with an id
        $type = Types::select('types.*')->findOrFail($id);
     
        // debug dd($type);

        // return to the show view
        return view('types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //debug dd($request);

        // validate inputs
        $request->validate([
            'type'=>'required',
        ]);

        // select the user with id
        $type = Types::findOrFail($id);

        $type->update([
            'type'=>$request->type,
        ]);

        return redirect()->route('types.index')
            ->with('success', 'type updated!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = Types::findOrFail($id);

        $type->delete();

        return redirect()->route('types.index')
            ->with('success', 'type deleted!!');
    }
}
