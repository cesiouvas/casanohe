<!-- extends from layout/main -->
@extends('layout.main')
@section('content')

<div class="pt-4" style="display:flex; justify-content:center; align-items:center;">
    <div class="rounded-5 p-2" style="border: 8px solid #ffcc23; background-color: #fcf386; width: 80vh;">
        <form action="{{ route('custom.update', $custom->cusid) }}" method="POST">
            <p class="ps-3 pt-3"><a href="{{route('custom.index')}}"><i class="fa-solid fa-arrow-left fa-xl" style="color: #000000;"></i></a></p>
            <h1 class="text-center">Editar personalización</h1>
            <!-- protection against injections -->
            @csrf
            @method('PUT')
            <h4 class="p-4">Pedido personalizado de: <small>{{$custom->name}} {{$custom->surname}} ({{$custom->email}})</small></h4>

            <div class="d-flex justify-content-center">
                <div class="p-3 w-100">
                    <label for="status">Estado</label>
                    <select class="form-select" name="status" id="status">
                        <option value="0" {{ $custom->status == 0 ? 'selected' : '' }}>Registrado</option>
                        <option value="1" {{ $custom->status == 1 ? 'selected' : '' }}>Admitido</option>
                        <option value="2" {{ $custom->status == 2 ? 'selected' : '' }}>En preparación</option>
                        <option value="3" {{ $custom->status == 3 ? 'selected' : '' }}>En reparto</option>
                        <option value="4" {{ $custom->status == 4 ? 'selected' : '' }}>Entregado</option>
                    </select>
                </div>
                <div class="p-3 w-100">
                    <label for="quantity">Cantidad</label>
                    <input class="form-control" type="number" name="quantity" id="quantity" value="{{ $custom->quantity }}">
                </div>
            </div>
            <div class="p-3 w-100">
                <label for="price">Precio estimado</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="price" id="price" value="{{ $custom->price }}">
                    <div class="input-group-append">
                        <span class="input-group-text">€</span>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="p-3 w-100">
                    <label for="desc">Comentarios</label>
                    <textarea class="form-control" name="comments" id="comments" cols="30" rows="5">{{ $custom->comments }}</textarea>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="p-3 w-100">
                    <label for="desc">Mensaje para el cliente</label>
                    <textarea class="form-control" name="admin_msg" id="admin_msg" cols="30" rows="5">{{ $custom->admin_msg }}</textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end p-3">
                <button class="btn btn-warning" type="submit">Editar personalización</button>
            </div>
        </form>
    </div>
</div>
<br><br><br><br><br><br>

@endsection