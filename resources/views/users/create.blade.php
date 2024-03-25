@extends('layout.styles')

<div>
    <form action="{{route('users.store')}}" method="POST">
        <div class="form-group p-3">
            <!-- protection against injections -->
            @csrf
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name">

            <label for="surname">Apellidos</label>
            <input type="text" name="surname" id="surname">
        </div>
        <div class="form-group p-3">
            <label for="email">Email</label>
            <input type="text" name="email" id="email">

            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password">
        </div>
        <div class="form-group p-3">
            <label for="dni">DNI</label>
            <input type="text" name="dni" id="dni">

            <label for="type">Tipo</label>
            <select name="type" id="type">
                <option selected disabled>--selecciona un tipo</option>
                <option value="0">Usuario</option>
                <option value="1">Admin</option>
            </select>
        </div>
        <button class="btn" type="submit">Crear usuario</button>
    </form>
</div>