@extends('layout.styles')
@extends('layout.main')
@section('content')

<div class="pt-4" style="display:flex; justify-content:center; height:100%; align-items:center;">
    <div class="rounded-5 p-2" style="border: 8px solid #ffcc23; background-color: #fcf386;">
        <form action="{{route('users.update', $user->id)}}" method="POST">
            <p><a href="{{route('users.index')}}">Volver (cambiar por flecha)</a></p>
            <h1 class="text-center">Crear usuario</h1>
            <!-- protection against injections -->
            @csrf
            <!-- method put to update -->
            @method('PUT')
            <div class="form-group p-3">

                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" value="{{$user->name}}">

                <label for="surname">Apellidos</label>
                <input type="text" name="surname" id="surname" value="{{$user->surname}}">
            </div>
            <div class="form-group p-3">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="{{$user->email}}" disabled>
            </div>
            <div class="form-group p-3">
                <label for="dni">DNI</label>
                <input type="text" name="dni" id="dni" value="{{$user->dni}}">

                <label for="type">Tipo</label>
                <select name="type" id="type">
                    @if($user->type == 0)
                    <option value="0" selected>Usuario</option>
                    <option value="1">Admin</option>
                    @else
                    <option value="0">Usuario</option>
                    <option value="1" selected>Admin</option>
                    @endif
                </select>
            </div>
            <button class="btn" type="submit">Editar usuario</button>
        </form>
    </div>
</div>