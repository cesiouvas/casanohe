@include('layout.styles')
@extends('layout.main')
@section('content')

{{ $total = 0 }}

<div class="pt-4 w-100 d-flex justify-content-center">
    <div class="rounded-5 p-2" style="border: 8px solid #ffcc23; background-color: #fcf386; width: 80vh;">
        <p class="ps-3 pt-3"><a href="{{ route('shoppingCart.show',$user->id) }}"><i class="fa-solid fa-arrow-left fa-xl" style="color: #000000;"></i></a></p>
        <h1>Datos de envío</h1>
        <p>{{ $user->country }}, {{ $user->city }}</p>
        <p>{{ $user->address }} - {{ $user->cp }}</p>
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
                        <p>{{ $prodLine->name }} {{ $prodLine->price }} € x {{ $prodLine->scquantity }} unidades</p>
                    </div>
                </td>
                <td>
                    {{ $prodLine->price * $prodLine->scquantity}} €
                    <?php $total += $prodLine->price * $prodLine->scquantity ?>
                </td>
            </tr>
            @endforeach
            <tr>
                <td class="d-flex flex-row-reverse">
                    <b>IMPORTE TOTAL</b>
                </td>
                <td>
                    <p>{{ $total }} €</p>
                </td>
            </tr>
        </table>
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <input id="userId" type="hidden" name="userId" value="{{ $user->id }}">
            <input id="costeTotal" type="hidden" name="costeTotal" value="{{ $total }}">
            <div class="d-flex justify-content-end p-3">
                <button type="submit" class="btn btn-warning">Confirmar pedido</button>
            </div>
        </form>
    </div>
</div>

@endsection