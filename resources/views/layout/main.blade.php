<!DOCTYPE html>
<html lang="en">
@include('layout.styles')

<body>
    <header>
        <a href="{{route('users.index')}}">Usuarios</a>
            </header>
    <div>
        <!-- insert content section -->
        @yield('content')
    </div>
    <footer>OJETE</footer>
</body>

</html>