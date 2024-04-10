<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();
     
        // return to the create view
        return view('users.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //debug dd($request);

        // validate inputs
        $request->validate([
            'name'=>'required',
            'surname'=>'required',
            'email'=>'required',
            'password'=>['required', 'min:8'],
            'dni'=>'required',
            'type'=>'required',
        ]);

        User::create([
            'name'=>$request->name,
            'surname'=>$request->surname,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'dni'=>$request->dni,
            'type'=>$request->type,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'user created!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // select all from table users with an id
        $user = User::select('users.*')->findOrFail($id);
     
        // debug dd($user);

        // return to the show view
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // select all from table users with an id
        $user = User::select('users.*')->findOrFail($id);
     
        // debug dd($user);

        // return to the edit view
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate inputs
        $request->validate([
            'name'=>'required',
            'surname'=>'required',
        ]);

        // select the user with id
        $user = User::findOrFail($id);

        // update user
        $user->update([
            'name'=>$request->name,
            'surname'=>$request->surname,
            'dni'=>$request->dni,
            'type'=>$request->type,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'user updated!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'user deleted!!');
    }
}
