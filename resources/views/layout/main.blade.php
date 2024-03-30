<!DOCTYPE html>
<html lang="es">
@include('layout.styles')

<body style="height: 100vh; background-color: #f8ffe3;">
    <header>
        <div style="background-color: #a5be00;">
            <nav class="navbar navbar-light pe-3">
                <div class="d-flex">
                    <img src="" alt="logo">
                    <h4 class="ps-2">Casanohe</h4>
                </div>
                <button class="btn btn-warning" style="background-color: ffa006;">Log out</button>
            </nav>
            <nav class="d-flex justify-content-evenly">
                <a href="{{route('users.index')}}">Usuarios</a>
                <a href="{{route('types.index')}}">Tipos</a>
                <a href="{{route('products.index')}}">Productos</a>
            </nav>
        </div>

    </header>
    <div class="p-2">
        <!-- insert content section -->
        @yield('content')
    </div>
    <footer>OJETE</footer>
</body>

</html>