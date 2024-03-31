@extends('layout.styles')
@extends('layout.main')
@section('content')

<div class="pt-4" style="display:flex; justify-content:center; height:100%; align-items:center;">
    <div class="rounded-5 p-2" style="border: 8px solid #ffcc23; background-color: #fcf386; width: 80vh;">
        <form action="{{route('types.update', $type->id)}}" method="POST">
            <p class="ps-3 pt-3"><a href="{{route('types.index')}}"><i class="fa-solid fa-arrow-left fa-xl" style="color: #000000;"></i></a></p>
            <h1 class="text-center">Editar tipo</h1>
            <!-- protection against injections -->
            @csrf
            <!-- method put to update -->
            @method('PUT')
            <div class="d-flex justify-content-center">
                <div class="p-3 w-100">
                    <label for="type">Tipo</label>
                    <input class="form-control" type="text" name="type" id="type" value="{{$type->type}}">
                </div>
            </div>
            <div class="d-flex justify-content-end p-3">
                <button class="btn btn-warning" type="submit">Editar tipo</button>
            </div>
        </form>
    </div>
</div>
@endsection