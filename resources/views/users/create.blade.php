@extends('layout.styles')
@extends('layout.main')
@section('content')

<div class="pt-4" style="display:flex; justify-content:center; height:100%; align-items:center;">
    <div class="rounded-5 p-2" style="border: 8px solid #ffcc23; background-color: #fcf386;">
        <form action="{{route('users.store')}}" method="POST">
            <p class="ps-3 pt-3"><a href="{{route('users.index')}}"><i class="fa-solid fa-arrow-left fa-xl" style="color: #000000;"></i></a></p>
            <h1 class="text-center">Crear usuario</h1>
            <!-- protection against injections -->
            @csrf
            <div class="d-flex justify-content-center">
                <div class="p-3">
                    <label for="name">Nombre</label><br>
                    <input class="form-control" type="text" name="name" id="name">
                </div>

                <div class="p-3">
                    <label for="surname">Apellidos</label><br>
                    <input class="form-control" type="text" name="surname" id="surname">
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="p-3">
                    <label for="email">Email</label><br>
                    <input class="form-control" type="text" name="email" id="email">
                </div>
                <div class="p-3">

                    <label for="password">Contraseña</label><br>
                    <input class="form-control" type="password" name="password" id="password">
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="p-3">
                    <label for="dni">DNI</label><br>
                    <input class="form-control" type="text" name="dni" id="dni">
                </div>

                <div class="p-3">
                    <label for="type">Tipo</label><br>
                    <select class="form-select" name="type" id="type">
                        <option selected disabled>--selecciona un tipo</option>
                        <option value="0">Usuario</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end p-3">
                <button class="btn btn-warning" type="submit">Crear usuario</button>
            </div>
        </form>
    </div>
</div>
@endsection