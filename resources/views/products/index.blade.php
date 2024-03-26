<!-- extends from layout/main -->
@extends('layout.main')
@section('content')

<div>
    <table class="table">
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Tipo</th>
            <th>Subtipo</th>
            <th>Cantidad</th>
            <th>Precio</th>
        </tr>

        @foreach($products as $prod)
        <tr>
            <td>{{$prod->name}}</td>
            <td>{{$prod->desc}}</td>
            <td>{{$prod->type_id}}</td>
            <td>{{$prod->subtype}}</td>
            <td>{{$prod->quantity}}</td>
            <td>{{$prod->price}}</td>
        </tr>
        @endforeach
    </table>
    <button><a href="{{route('products.create')}}">Crear producto</a></button>
</div>

@endsection
