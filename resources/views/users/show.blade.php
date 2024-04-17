@extends('layout.styles')
@extends('layout.main')
@section('content')


<div class="pt-4 w-100 d-flex justify-content-center">
    <div>
        <p class="ps-3 pt-3"><a href="{{route('users.index')}}"><i class="fa-solid fa-arrow-left fa-xl" style="color: #000000;"></i></a></p>
        <h1>Vista {{$user->name}} {{$user->surname}}</h1>
        <p>DNI: {{$user->dni}} Email: {{$user->email}}</p>
    </div>
</div>

<div class="pt-4 w-75 mx-auto">
    <table class="table">
        <tr>
            <th>Precio total</th>
            <th>Estado del pedido</th>
            <th>Opciones</th>
        </tr>

        @foreach ($orders as $order)
        <tr>
            <th>{{$order->totalPrice}} €</th>
            <th>{{$order->order_status}}</th>
            <th><a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-success"><i class="fa-regular fa-pen-to-square"></i></a></th>
        </tr>
        @endforeach
    </table>
</div>

@endsection