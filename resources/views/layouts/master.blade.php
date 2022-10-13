<!DOCTYPE html>
<html lang='es'>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-sacale=1">
        <meta name="description" content="Ejemplo CRUD con laravel - Larabikes">
        <!-- yield mostrará el contenido de la sección titulo que se especificará en la vista hija-->
        <title>{{config('app.name')}} - @yield('titulo')</title>

        <!-- CSS para Bootstrap-->
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
        <script src="{{ asset('js/bootstrap.min.js')}}" defer></script>

        <!-- FAVICON-->
        <link rel="shortcut icon" href="{{config('app.favicon')}}" type="image/png">
    </head>
    <body class="container p-3">



        
        <!--PARTE SUPERIOR-->
        @section('navegacion')
        <nav>
            <ul class="nav nav-pills my-3">
                <li class="nav-item mr-2">
                    <figure>
                        <a clas="nav-link" href="{{url('/')}}">
                            <img id="inicio" alt="logo larabaikes"
                                src="{{asset(config('app.favicon'))}}"
                                width="70">
                        </a>
                    </figure>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link" href="{{route('bikes.index')}}">Garaje</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('bikes.create')}}">Nueva Moto</a>
                </li>
            </ul>
        </nav>
        @show




        


        <!--PARTE CENTRAL-->
        <h1 class="my-2">Gestor de motos Larabikes</h1>

        <main>
            <!--yield mostrará el titulo especificado en la vista hija-->
            <h2>@yield('titulo')</h2>


            <!--inclusión condicionada de sub-vistas -->
            @includeWhen(Session::has('success'), 'layouts.success')
            @includeWhen($errors->any(), 'layouts.errors')



            <!--yield mostrará la sección "contenido de la vista hija"-->
            @yield('contenido')



            <div class="btn-group" role="group" arial-label="links">
                <!--define y muestra la sección enlaces -->
                @section('enlaces')
                    <a href="{{ url('/') }}" class="btn btn-primary m-2">Inicio</a>
                @show

            </div>
        </main>


        <!--PARTE INFERIOR-->
        @section('pie')
        <footer class="page-footer font-small p-4 bg-light">
            <p>Aplicación creada por (TODO: AUTOR) como ejemplo de clase.
                Desdarrollada haciendo usu de <b>Laravel</b> y <b>Bootstrap</b>.
            </p>
        </footer>
        @show



    </body>
</html>