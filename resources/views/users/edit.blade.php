@extends('layout.styles')
@extends('layout.main')
@section('content')

<div class="pt-4" style="display:flex; justify-content:center; height:100%; align-items:center;">
    <div class="rounded-5 p-2" style="border: 8px solid #ffcc23; background-color: #fcf386;">
        <form action="{{route('users.update', $user->id)}}" method="POST">
            <p class="ps-3 pt-3"><a href="{{route('users.index')}}"><i class="fa-solid fa-arrow-left fa-xl" style="color: #000000;"></i></a></p>
            <h1 class="text-center">Editar usuario</h1>
            <!-- protection against injections -->
            @csrf
            <!-- method put to update -->
            @method('PUT')
            <div class="d-flex justify-content-center">
                <div class="p-3">
                    <label for="name">Nombre</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}">
                </div>
                <div class="p-3">
                    <label for="surname">Apellidos</label>
                    <input class="form-control" type="text" name="surname" id="surname" value="{{$user->surname}}">
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <div class="p-3 w-100">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{$user->email}}" disabled>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <div class="p-3 w-100">
                    <label for="dni">DNI</label>
                    <input class="form-control" type="text" name="dni" id="dni" value="{{$user->dni}}">
                </div>
                <div class="p-3 w-100">
                    <label for="type">Tipo</label>
                    <select class="form-select" name="type" id="type">
                        @if($user->type == 0)
                        <option value="0" selected>Usuario</option>
                        <option value="1">Admin</option>
                        @else
                        <option value="0">Usuario</option>
                        <option value="1" selected>Admin</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end p-3">
                <button class="btn btn-warning" type="submit">Editar usuario</button>
            </div>
        </form>
    </div>
</div>
@endsection