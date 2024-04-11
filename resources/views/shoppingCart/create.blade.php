@extends('layout.main')
@section('content')

<div class="pt-4" style="display:flex; justify-content:center; height:100%; align-items:center;">
    <div class="rounded-5 p-2" style="border: 8px solid #ffcc23; background-color: #fcf386;">
        <form action="{{ route('shoppingCart.store') }}" method="POST">
            <p class="ps-3 pt-3"><a href="{{ route('shoppingCart.show', $user->id) }}"><i class="fa-solid fa-arrow-left fa-xl" style="color: #000000;"></i></a></p>
            <h1 class="text-center">Añadir producto a la cesta</h1>
            <!-- protection against injections -->
            @csrf
            <input class="d-none" type="text" name="user_id" id="user_id" value="{{$user->id}}">
            <div class="d-flex justify-content-center">
                <div class="p-3">
                    <label for="product">Producto</label><br>
                    <select class="form-select" name="product_id" id="product_id">
                        <option selected disabled>--selecciona un tipo</option>
                        @foreach ($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="p-3">
                    <label for="quantity">Cantidad</label><br>
                    <input class="form-control" type="number" name="quantity" id="quantity">
                </div>
            </div>
            <div class="d-flex justify-content-end p-3">
                <button class="btn btn-warning" type="submit">Añadir producto</button>
            </div>
        </form>
    </div>
</div>

@endsection