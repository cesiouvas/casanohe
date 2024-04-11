@include('layout.styles')
@extends('layout.main')
@section('content')

<div class="pt-4 w-100 d-flex justify-content-center">
    <div class="rounded-5 p-2" style="border: 8px solid #ffcc23; background-color: #fcf386; width: 80vh;">
        <p class="ps-3 pt-3"><a href="{{ route('shoppingCart.show',$user->id) }}"><i class="fa-solid fa-arrow-left fa-xl" style="color: #000000;"></i></a></p>
        <h1>Confirmar pedido</h1>
        <form action="{{ route('orders.store') }}" method="POST">
            <input type="number" id="user_id" name="user_id" value="{{ $user->id }}" hidden>

        </form>
    </div>
</div>

@endsection