@extends('layout.styles')
@extends('layout.main')
@section('content')

<div style="display:flex; justify-content:center; height:100%; align-items:center;">
    <div>
        <form action="{{route('users.store')}}" method="POST">
            <p><a href="{{route('users.index')}}">Volver (cambiar por flecha)</a></p>
            <h1>Crear usuario</h1>
            <!-- protection against injections -->
            @csrf
            <div class="row">
                <div class="col">
                    <label for="name">Nombre</label><br>
                    <input type="text" name="name" id="name">
                </div>

                <div class="col">
                    <label for="surname">Apellidos</label>
                    <input type="text" name="surname" id="surname">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="email">Email</label><br>
                    <input type="text" name="email" id="email">
                </div>
                <div class="col">

                    <label for="password">Contraseña</label><br>
                    <input type="password" name="password" id="password">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="dni">DNI</label><br>
                    <input type="text" name="dni" id="dni">
                </div>

                <div class="col">
                    <label for="type">Tipo</label><br>
                    <select name="type" id="type">
                        <option selected disabled>--selecciona un tipo</option>
                        <option value="0">Usuario</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
            </div>
            <button class="btn" type="submit">Crear usuario</button>
        </form>
    </div>
</div>
@endsection