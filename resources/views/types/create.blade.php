@extends('layout.styles')

<div>
    <form action="{{route('types.store')}}" method="POST">
        <div class="form-group p-3">
            <!-- protection against injections -->
            @csrf
            <label for="type">Tipo</label>
            <input type="text" name="type" id="type">
        </div>
        <button class="btn" type="submit">Crear tipo</button>
    </form>
</div>