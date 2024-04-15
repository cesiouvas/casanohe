@include('layout.styles')
@extends('layout.main')
@section('content')

<div class="pt-4 w-100 d-flex justify-content-center">
    <div class="rounded-5 p-2" style="border: 8px solid #ffcc23; background-color: #fcf386; width: 80vh;">
        <p class="ps-3 pt-3"><a href="{{ route('shoppingCart.show',$user->id) }}"><i class="fa-solid fa-arrow-left fa-xl" style="color: #000000;"></i></a></p>
        <h1>Confirmar pedido</h1>
        <p>Su pedido será procesado a continuación</p>
        <p>Gracias por confiar en nosotros</p>
        <input type="number" id="user_id" name="user_id" value="{{ $user->id }}" hidden>
        <table class="table">
            <tr>
                <th>Artículos seleccionados</th>
                <th>Total</th>
            </tr>
            @foreach ($sc as $prodLine)
            <tr>
                <td>
                    <div>
                        <img src="{{ asset('img/' . $prodLine->image . '.png' ) }}" alt="imagen {{ $prodLine->name }}" style="width: 50px">
                        <p>{{ $prodLine->name }} {{ $prodLine->price }} € x {{ $prodLine->scquantity }}</p>
                    </div>
                </td>
                <td>{{ $prodLine->price * $prodLine->scquantity}} €</td>
            </tr>
            @endforeach
        </table>
        <form action="{{ route('orders.store') }}" method="POST">

            <!-- lo más cutre del mundo pero poner los inputs en hidden y enviarlos en el formulario para crear el pedido -->
            <input type="text" value="{{ $prodLine->price * $prodLine->scquantity}}" hidden>
        </form>
    </div>
</div>

@endsection