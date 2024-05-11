<!DOCTYPE html>
<html lang="es">
@include('layout.styles')

<style>
    a {
        text-decoration: none;
        color: black;
    }

    .menu {
        padding: 6px;
    }

    .menu:hover {
        background-color: #f2ffc8;
        border-radius: 10px;
    }
</style>

<body style="background-color: #f2ffc8; min-height: 100vh; position: relative;">
    <header>
        <div style="background-color: #a5be00;" class="pb-2">
            <nav class="navbar navbar-light pe-3">
                <div class="d-flex">
                    <img src="{{ asset('img/logo.png') }}" alt="logo" style="width: 70px;">
                    <h4 class="ps-2">Casanohe</h4>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    <button type="submit" class="btn btn-warning" style="background-color: ffa006;">Log out</button>

                </form>
            </nav>
            <nav class="d-flex justify-content-evenly">
                <a class="menu" href="{{route('users.index')}}">Usuarios</a>
                <a class="menu" href="{{route('types.index')}}">Tipos</a>
                <a class="menu" href="{{route('products.index')}}">Productos</a>
                <a class="menu" href="{{route('orders.index')}}">Pedidos</a>
            </nav>
        </div>
    </header>
    <div class="p-2">
        <!-- insert content section -->
        @yield('content')
    </div>
    <footer class="footer bg-dark text-white text-center py-3 fixed-bottom">
        casanohe ©
    </footer>
</body>

</html>