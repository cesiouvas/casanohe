@extends('layout.main')
@section('content')

<?php $precioTotal = 0 ?>

<div class="pt-4 w-100 d-flex justify-content-center">
    <div>
        <p class="ps-3 pt-3"><a href="{{route('users.index')}}"><i class="fa-solid fa-arrow-left fa-xl" style="color: #000000;"></i></a></p>
        <div class="row">
            <div class="col-12 col-md-8">
                <h1>Carrito de {{$user->name}} {{$user->surname}} {{$user->id}}</h1>
            </div>
            <div class="col-6 col-md-4">Costes totales</div>
        </div>

        @if ($cart == null) <!-- Carrito vacío -->
        <p>Este carrito está vaciío, añade productos con el botón de abajo</p>
        @else

        <div class="row">
            @foreach ($cart as $cart_line)
            <?php
            // precio total de la línea se va reiniciando
            $precioTotalLinea = 0
            ?>

            <!-- recorremos cantidad de productos por cada línea -->
            @for ($i = 0; $i < $cart_line->quantity_line; $i++)

                <?php
                // precio total de la línea se va sumando
                $precioTotalLinea += $cart_line->price
                ?>

                @endfor

                <?php
                // sumamos el precio total de la línea al precio total
                $precioTotal += $precioTotalLinea
                ?>
                <div class="col-6 col-md-4">{{$cart_line->name}}</div>
                <div class="col-6 col-md-4">{{$cart_line->quantity_line}} unidades</div>
                <div class="col-6 col-md-4">
                    <div class="d-flex">
                        <p class="pe-2">{{$precioTotalLinea}} €</p>
                        <form action="{{route('shoppingCart.destroy', $cart_line->scid)}}" method="POST">
                            <a href="{{route('shoppingCart.edit', $cart_line->scid)}}" class="btn btn-outline-success">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger"><i class="fa-regular fa-trash-can"></i></button>
                        </form>
                    </div>
                </div>

                @endforeach
        </div>

        <div class="row">
            <div class="col-12 col-md-8">Precio total </div>
            <div class="col-6 col-md-4">
                <p>{{$precioTotal}} €</p>
            </div>
        </div>

        @endif

        <div class="d-flex justify-content-end p-3">
            <button class="btn btn-warning"><a href="{{ route('shoppingCart.create', $user->id) }}">Añadir producto a la cesta</a></button>
        </div>
    </div>

</div>

<div class="d-flex justify-content-center p-3">
    <button class="btn btn-warning"><a href="{{ route('orders.create', $user->id) }}">Hacer pedido</a></button>
</div>



@endsection