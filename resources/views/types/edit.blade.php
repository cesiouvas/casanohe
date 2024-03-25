@extends('layout.styles')

<div>
    <form action="{{route('types.update', $type->id)}}" method="POST">
        <!-- protection against injections -->
        @csrf
        <!-- method put to update -->
        @method('PUT')
        <div class="form-group p-3">
            <label for="type">Tipo</label>
            <input type="text" name="type" id="type" value="{{$type->type}}">
        </div>
        <button class="btn" type="submit">Editar tipo</button>
</div>