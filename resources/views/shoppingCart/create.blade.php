@extends('layout.main')
@section('content')

<div class="pt-4" style="display:flex; justify-content:center; height:100%; align-items:center;">
    <div class="rounded-5 p-2" style="border: 8px solid #ffcc23; background-color: #fcf386;">
        <form action="{{ route('shoppingCart.store') }}" method="POST"></form>
        <p class="ps-3 pt-3"><a href="{{route('users.index')}}"><i class="fa-solid fa-arrow-left fa-xl" style="color: #000000;"></i></a></p>
        <h1 class="text-center">Añadir producto a la cesta</h1>
        <!-- protection against injections -->
        @csrf
        <input type="text" name="aaa" id="aaa" value="{{$id}}">
        <div class="d-flex justify-content-center">
            <div class="p-3">
                <label for="type">Producto</label><br>
                <select class="form-select" name="type" id="type">
                    <option selected disabled>--selecciona un tipo</option>
                    @foreach ($products as $product)
                    <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="p-3">
                <label for="dni">Cantidad</label><br>
                <input class="form-control" type="number" name="quantity" id="quantity">
            </div>
        </div>
    </div>
</div>

@endsection