@include('layout.styles')
@extends('layout.main')
@section('content')

<div class="pt-4" style="display:flex; justify-content:center; align-items:center;">
    <div class="rounded-5 p-2" style="border: 8px solid #ffcc23; background-color: #fcf386; width: 80vh;">
        <p class="ps-3 pt-3"><a href="{{route('orders.index')}}"><i class="fa-solid fa-arrow-left fa-xl" style="color: #000000;"></i></a></p>
        <h1>Pedido de {{$user->name}} {{$user->surname}} {{$user->id}}</h1>
        <!-- AÑADIR DATOS DE ENVIO Y ESTADO -->
        <div class="p-2 bg-light">

        
        <div class="row">
            <div class="col-12 col-md-8">

            </div>
            <div class="col-6 col-md-4">Costes totales</div>
        </div>

        <div class="row">
            @foreach ($orderLines as $line)
            <?php
            // precio total de la línea se va reiniciando
            $precioTotalLinea = 0
            ?>

            @for ($i = 0; $i < $line->line_quantity; $i++)
                <?php
                // precio total de la línea se va sumando
                $precioTotalLinea += $line->price;
                ?>
                @endfor
                <div class="col-6 col-md-4">{{ $line->name }}</div>
                <div class="col-6 col-md-4">{{ $line->price }}€ x {{ $line->line_quantity }} unidades</div>
                <div class="col-6 col-md-4">
                    <div class="d-flex">
                        <p class="pe-2">{{ $precioTotalLinea }} €</p>
                    </div>
                </div>

                @endforeach
        </div>

        <div class="row">
            <div class="col-12 col-md-8">Precio total </div>
            <div class="col-6 col-md-4">
                <p>{{ $order->totalPrice }} €</p>
            </div>
        </div>

        </div>
    </div>



</div>

@endsection