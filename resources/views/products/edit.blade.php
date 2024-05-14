@include('layout.styles')
@extends('layout.main')
@section('content')

<div class="pt-4" style="display:flex; justify-content:center; height:100%; align-items:center;">
    <div class="rounded-5 p-2" style="border: 8px solid #ffcc23; background-color: #fcf386; width: 80vh;">
        <form action="{{route('products.update', $prod->id)}}" method="POST">
            <p class="ps-3 pt-3"><a href="{{route('products.index')}}"><i class="fa-solid fa-arrow-left fa-xl" style="color: #000000;"></i></a></p>
            <h1 class="text-center">Editar producto</h1>
            <!-- protection against injections -->
            @csrf
            <!-- method put to update -->
            @method('PUT')
            <div class="d-flex justify-content-center">
                <div class="p-3 w-100">
                    <label for="name">Nombre</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{$prod->name}}">
                </div>
                <div class="p-3 w-100">
                    <label for="image">Imagen (nombre)</label>
                    <input class="form-control" type="text" name="image" id="image" value="{{$prod->image}}"></input>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="p-3 w-100">
                    <label for="desc">Descripción</label>
                    <textarea class="form-control" name="desc" id="desc" cols="30" rows="5">{{$prod->desc}}</textarea>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="p-3 w-100">
                    <label for="type">Tipo</label>
                    <select class="form-select" name="type" id="type">

                        @foreach ($types as $type)

                        @if ($prod->type_id == $type->id)
                        <option value="{{$prod->type_id}}" selected>{{$type->type}}</option>
                        @else
                        <option value="{{$prod->type_id}}">{{$type->type}}</option>
                        @endif
                        @endforeach

                    </select>
                </div>
                <div class="p-3 w-100">
                    <label for="subtype">Subtipo</label>
                    <input class="form-control" type="text" name="subtype" id="subtype" value="{{$prod->subtype}}">
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <div class="p-3 w-100">
                    <label for="quantity">Cantidad</label>
                    <input class="form-control" type="number" name="quantity" id="quantity" value="{{$prod->quantity}}">
                </div>

                <div class="p-3 w-100">
                    <label for="price">Precio</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="price" id="price" value="{{$prod->price}}">
                        <div class="input-group-append">
                            <span class="input-group-text">€</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end p-3">
                <button class="btn btn-warning" type="submit">Editar Producto</button>
            </div>
        </form>
    </div>
</div>
@endsection