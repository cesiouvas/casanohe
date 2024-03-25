<!DOCTYPE html>
<html lang="en">
@include('layout.styles')

<body>
    <header>
        <a href="{{route('users.index')}}">Usuarios</a>
        <a href="{{route('types.index')}}">Tipos</a>
        <a href="{{route('products.index')}}">Productos</a>
            </header>
    <div>
        <!-- insert content section -->
        @yield('content')
    </div>
    <footer>OJETE</footer>
</body>

</html>