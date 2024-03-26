<!-- extends from layout/main -->
@extends('layout.main')
@section('content')

<div>
    <table class="table">
        <tr>
            <th>Tipo</th>
            <th>Opciones</th>
        </tr>

        @foreach($types as $tipo)
        <tr>
            <td>{{$tipo->type}}</td>
            <td>
                <form action="{{route('types.destroy', $tipo->id)}}" method="POST">
                    <button><a href="{{route('types.edit', $tipo->id)}}">Editar</a></button>
                    <button><a href="{{route('types.show', $tipo->id)}}">Ver</a></button>
                    @csrf
                    <!--  -->
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <button><a href="{{route('types.create')}}">Crear tipo</a></button>
</div>

@endsection