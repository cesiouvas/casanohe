@extends('layout.main')
@section('content')

<div>
<table class="table">
    <tr>
        <th>Carrito de</th>
    </tr>
    @foreach ($shoppingc as $sc)
    <tr>
        <td>{{}}</td>
    </tr>        
    @endforeach
</table>
</div>
@endsection