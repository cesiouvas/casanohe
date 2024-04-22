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
            <th>Personalizar</th>
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
                    <a href="{{route('products.edit', $prod->id)}}" class="btn btn-outline-success">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    <a href="{{route('products.show', $prod->id)}}" class="btn btn-outline-info">
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
                <a href="{{ route('custom.create', ['product' => $prod->id]) }}" class="btn btn-outline-warning"><i class="fa-solid fa-palette"></i></a>
            </td>
        </tr>
        @endforeach
    </table>
    <button class="btn btn-warning"><a href="{{route('products.create')}}">Crear producto</a></button>
</div>

@endsection