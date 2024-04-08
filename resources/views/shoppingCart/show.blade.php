@extends('layout.main')
@section('content')

<div>
    <h1>Carrito de {{$userCart[0]->name}} {{$userCart[0]->surname}}</h1>

    @if ($userCart[0]->product_id == null)
    <p>Este carrito está vaciío, añade productos con el botón de abajo</p>
    @endif

    <button class="btn btn-warning"><a href="{{ route('shoppingCart.create', $userCart[0]->id) }}">Añadir producto a la cesta</a></button>
</div>



@endsection