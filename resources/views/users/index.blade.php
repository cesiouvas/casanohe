<!-- extends from layout/main -->
@extends('layout.main')
@section('content')
<div>
    <table class="table">
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>DNI</th>
            <th>email</th>
            <th>Contraseña</th>
            <th>Tipo</th>
            <th>Opciones</th>
        </tr>

        @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->surname}}</td>
            <td>{{$user->dni}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->password}}</td>
            <td>{{$user->type}}</td>
            <td>
                <form action="{{route('users.destroy', $user->id)}}" method="POST">
                    <button><a href="{{route('users.edit', $user->id)}}">Editar</a></button>
                    <button><a href="{{route('users.show', $user->id)}}">Ver</a></button>
                    @csrf
                    <!--  -->
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>

        @endforeach
    </table>
    <button><a href="{{route('users.create')}}">Crear usuario</a></button>
</div>
@endsection