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
            <th>Carrito</th>
        </tr>

        @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->surname}}</td>
            <td>{{$user->dni}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->password}}</td>
            <!-- Sacar el tipo de usuario --> 
            @if ($user->type == 1)
            <td>Admin</td>
            @else
            <td>Usuario</td>
            @endif
            <td>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-success">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-info">
                        <i class="fa-regular fa-eye"></i>
                    </a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </form>
            </td>
            <td>
                <a href="{{route('shoppingCart.show', $user->id)}}" class="btn btn-outline-warning"><i class="fa-solid fa-cart-shopping"></i></a>
            </td>
        </tr>

        @endforeach
    </table>
    <button class="btn btn-warning"><a href="{{route('users.create')}}">Crear usuario</a></button>
</div>
@endsection