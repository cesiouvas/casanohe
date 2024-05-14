@extends('layout.main')
@section('content')

<div>
    <table class="table">
        <tr>
            <th>Producto</th>
            <th>Comentarios</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Opciones</th>
        </tr>

        @foreach ($custom as $co)
        <tr>
            <td>{{$co->name}}</td>
            <td>{{$co->comments}}</td>
            <td>{{$co->quantity}}</td>
            <td>{{$co->price}}€</td>
            <td>
                @switch($co->status)
                @case(0)
                Registrado
                @break
                @case(1)
                Admitido
                @break
                @case(2)
                En preparación
                @break
                @case(3)
                En reparto
                @break
                @case(4)
                Entregado
                @break
                @endswitch
            </td>
            <td>
            <form action="{{ route('custom.destroy', $co->id) }}" method="POST">
                    <a href="{{ route('custom.edit', $co->id) }}" class="btn btn-outline-success">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    <a href="{{ route('custom.show', $co->id) }}" class="btn btn-outline-info">
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