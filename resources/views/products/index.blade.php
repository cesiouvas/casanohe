<!-- extends from layout/main -->
@extends('layout.main')
@section('content')

<div>
    <table class="table">
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Imagen</th>
            <th>Tipo</th>
            <th>Subtipo</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Opciones</th>
        </tr>

        @foreach($products as $prod)
        <tr>
            <td>{{$prod->name}}</td>
            <td>{{$prod->desc}}</td>
            <td><img style="width: 20px;" src="{{ asset('img/' . $prod->image . '.png') }}" alt="{{$prod->image}}"></td>
            <td>{{$prod->type}}</td>
            <td>{{$prod->subtype}}</td>
            <td>{{$prod->quantity}}</td>
            <td>{{$prod->price}}€</td>
            <td>
                <form action="{{route('products.destroy', $prod->id)}}" method="POST">
                    <button><a href="{{route('products.edit', $prod->id)}}">Editar</a></button>
                    <button><a href="{{route('products.show', $prod->id)}}">Ver</a></button>
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <button><a href="{{route('products.create')}}">Crear producto</a></button>
</div>

@endsection
