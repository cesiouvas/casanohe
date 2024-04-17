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
                    <a href="{{route('types.edit', $tipo->id)}}"class="btn btn-outline-success">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    <a href="{{route('types.show', $tipo->id)}}" class="btn btn-outline-info">
                        <i class="fa-regular fa-eye"></i>
                    </a>
                    @csrf
                    <!--  -->
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <button class="btn btn-warning"><a href="{{route('types.create')}}" style="text-decoration: none; color: black;">Crear tipo</a></button>
</div>

@endsection