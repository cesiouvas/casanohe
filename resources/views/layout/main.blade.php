<!DOCTYPE html>
<html lang="en">
@include('layout.styles')

<body>
    <header>
        <nav class="navbar navbar-light bg-light pe-3">
            <img src="" alt="logo">
            <button class="btn btn-warning">Log out</button>
        </nav>
        <nav>
            <a href="{{route('users.index')}}">Usuarios</a>
            <a href="{{route('types.index')}}">Tipos</a>
            <a href="{{route('products.index')}}">Productos</a>
        </nav>

    </header>
    <div>
        <!-- insert content section -->
        @yield('content')
    </div>
    <footer>OJETE</footer>
</body>

</html>