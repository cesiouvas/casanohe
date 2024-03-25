@extends('layout.styles')

<div>
    <form action="{{route('products.store')}}" method="POST">
        <div class="form-group p-3">
            <!-- protection against injections -->
            @csrf
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name">

            <label for="desc">Descripción</label>
            <textarea name="desc" id="desc" cols="30" rows="5"></textarea>
        </div>
        <div class="form-group p-3">
            <label for="type">Tipo</label>
            <select name="type" id="type">
                <option value="0" selected>--Selecciona un tipo</option>
                @foreach($types as $product)
                <option value="{{$product->id}}">{{$product->type}}</option>
                @endforeach
            </select>
        </div>
        
        <button class="btn" type="submit">Crear producto</button>
    </form>
</div>