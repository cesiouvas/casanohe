<!-- extends from layout/main -->
@include('layout.styles')
@extends('layout.main')
@section('content')

<div class="pt-4" style="display:flex; justify-content:center; align-items:center;">
    <div class="rounded-5 p-2" style="border: 8px solid #ffcc23; background-color: #fcf386; width: 80vh;">
        <form action="{{ route('custom.store') }}" method="POST">
            <p class="ps-3 pt-3"><a href="{{route('products.index')}}"><i class="fa-solid fa-arrow-left fa-xl" style="color: #000000;"></i></a></p>
            <h1 class="text-center">Personalizar producto</h1>
            <!-- protection against injections -->
            @csrf
            <div class="visually-hidden">
                <input class="form-control" type="text" name="name" id="name" value="{{ $product->name }}">
                <input type="text" class="form-control" name="price" id="price" value="{{ $product->price + 3 }}">
                <input class="form-control" type="text" name="type" id="type" value="{{ $product->type_id }}">
                <input class="form-control" type="text" name="subtype" id="subtype" value="{{ $product->subtype }}">
                <textarea class="form-control" name="desc" id="desc" cols="30" rows="5">{{ $product->desc }}</textarea>
            </div>

            <div class="d-flex justify-content-center">
                <div class="p-3 w-100">
                    <label for="name">Nombre</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ $product->name }}" disabled>
                </div>
                <div class="p-3 w-100">
                    <label for="price">Precio aproximado</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="price" id="price" value="{{ $product->price + 3 }}" disabled>
                        <div class="input-group-append">
                            <span class="input-group-text">€</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="p-3 w-100">
                    <label for="desc">Descripción</label>
                    <textarea class="form-control" name="desc" id="desc" cols="30" rows="5" disabled>{{ $product->desc }}</textarea>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="p-3 w-100">
                    <label for="type">Tipo</label>
                    <input class="form-control" type="text" name="type" id="type" value="{{ $product->type }}" disabled>
                </div>
                <div class="p-3 w-100">
                    <label for="subtype">Subtipo</label>
                    <input class="form-control" type="text" name="subtype" id="subtype" value="{{ $product->subtype }}" disabled>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="p-3 w-100">
                    <label for="comments">Comentarios</label>
                    <textarea class="form-control" name="comments" id="comments" cols="30" rows="5"></textarea>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <div class="p-3 w-100">
                    <label for="type">Solicitante</label>
                    <select class="form-select" name="user" id="user">
                        <option value="0">-</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name . " " . $user->surname }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="p-3 w-100">
                    <label for="quantity">Cantidad</label>
                    <input class="form-control" type="number" name="quantity" id="quantity">
                </div>
            </div>

            <div class="d-flex justify-content-end p-3">
                <button class="btn btn-warning" type="submit">Personalizar Producto</button>
            </div>
        </form>
    </div>
</div>
<br><br><br><br>

@endsection