@include('layout.styles')
@extends('layout.main')
@section('content')

<div>
    <table class="table">
        <tr>
            <th>Usuario</th>
            <th>Precio total</th>
            <th>Estado</th>
            <th>Opciones</th>
        </tr>

        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->name }} {{ $order->surname }}</td>
            <td>{{ $order->totalPrice }} €</td>
            <!-- Asignación de textos (colores a futuro) al estado -->
            <td>
                @switch($order->order_status)
                @case(0)
                <p>Registrado</p>
                @break
                @case(1)
                <p>Admitido</p>
                @break
                @case(2)
                <p>En preparación</p>
                @break
                @case(3)
                <p>En reparto</p>
                @break
                @case(4)
                <p>Entregado</p>
                @break
                @endswitch
            </td>
            <td>
                <form action="{{ route('orders.destroy', $order->orderId) }}" method="POST">
                    <a href="{{ route('orders.show', $order->orderId) }}" class="btn btn-outline-info">
                        <i class="fa-regular fa-eye"></i>
                    </a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>

@endsection