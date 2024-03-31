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
            <nav class="d-flex justify-content-evenly pb-2">
                <a style="color: black; text-decoration: none;" href="{{route('users.index')}}">Usuarios</a>
                <a style="color: black; text-decoration: none;" href="{{route('types.index')}}">Tipos</a>
                <a style="color: black; text-decoration: none;" href="{{route('products.index')}}">Productos</a>
            </nav>
        </div>
    </header>
    <div class="p-2">
        <!-- insert content section -->
        @yield('content')
    </div>
    <footer>OJETE</footer>
</body>
<script src="https://kit.fontawesome.com/7962c0e335.js" crossorigin="anonymous"></script>

</html>