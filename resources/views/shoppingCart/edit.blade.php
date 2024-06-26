@extends('layout.main')
@section('content')

<div class="pt-4" style="display:flex; justify-content:center; height:100%; align-items:center;">
    <div class="rounded-5 p-2" style="border: 8px solid #ffcc23; background-color: #fcf386;">
        <form action="{{ route('shoppingCart.update', $scline->id) }}" method="POST">
            <p class="ps-3 pt-3"><a href="{{route('shoppingCart.show', $scline->user_id)}}"><i class="fa-solid fa-arrow-left fa-xl" style="color: #000000;"></i></a></p>
            <h1 class="text-center">Editar producto de la cesta</h1>
            <!-- protection against injections -->
            @csrf
            <!-- method put to update -->
            @method('PUT')
            <!-- user id to make the redirection -->
            <input class="d-none" type="text" name="user_id" id="user_id" value="{{$scline->user_id}}">

            <div class="d-flex justify-content-center">
                <div class="p-3">
                    <label for="product">Producto</label><br>
                    <select class="form-select" name="product_id" id="product_id">
                        @foreach ($products as $product)
                        <!-- select products -> if edited set selected -->
                        @if ($product->id == $scline->product_id)
                        <option value="{{$product->id}}" selected>{{$product->name}}</option>
                        @else
                        <option value="{{$product->id}}">{{$product->name}}</option>
                        @endif

                        @endforeach
                    </select>
                </div>
                <div class="p-3">
                    <label for="quantity">Cantidad</label><br>
                    <input class="form-control" type="number" name="quantity" id="quantity" value="{{$scline->quantity}}">
                </div>
            </div>
            <div class="d-flex justify-content-end p-3">
                <button class="btn btn-warning" type="submit">Editar ínea de pedido</button>
            </div>
        </form>
    </div>
</div>

@endsection