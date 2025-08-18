<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="window=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        @yield('css')
        <title>@yield('title')</title>
    </head>
    <body>
        <div class="container">
            <a href="{{ url('/') }}">Inicio</a>
            @if (Auth::user())
                 | <a href="{{ url('categorias') }}">Categorías</a> | 
                <a href="{{ url('usuarios') }}">Usuarios</a> | 
                <a href="{{ url('rols') }}">Roles</a> | 
                <a href="{{ url('logout') }}">Salir</a>
            @endif
            @yield('content')
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
        @yield('js')
    </body>
</html>