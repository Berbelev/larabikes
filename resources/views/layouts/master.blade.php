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
        <!--MENSAJES condicionados al entorno-->
        @env(['local', 'test'])
            <x-local :mode="App::environment()" />
        @endenv

        @env(['staging', 'production'])
            <x-production/>
        @endenv


        @section('navegacion')
        {{--@php($pagina = Route::currentRouteName())--}}
        @php($pagina = $pagina ?? '')
        <nav>
            <ul class="nav nav-pills flex-column flex-sm-row my-3">
                <li class="nav-item mr-2">
                    <figure>
                        <a clas="nav-link {{$pagina=='portada'? 'active':''}}"
                        href="{{url('/')}}">
                            <img id="inicio" alt="logo larabaikes"
                                src="{{asset(config('app.favicon'))}}"
                                width="80">
                        </a>
                    </figure>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link {{$pagina=='bikes.index'?'active':''}}"
                    href="{{route('bikes.index')}}">Garaje</a>
                </li>

                <!--Muestra nueva moto solo para usuarios ifentificados-->
                @auth
                <li class="nav-item">
                    <a class="nav-link {{$pagina=='bikes.create'?'active':''}}"
                     href="{{route('bikes.create')}}">Nueva Moto</a>
                </li>
                @endauth
            </ul>
        </nav>
        @show







        <!--PARTE CENTRAL-->
        <h1 class="my-2">Gestor de motos Larabikes</h1><br>

        <main>

            <!--yield mostrará el titulo especificado en la vista hija-->
            <h2 class="text-muted">@yield('titulo')</h2>


            <!--inclusión condicionada de sub-vistas -->
            @if(Session::has('success'))
                <x-alert type="success" message="{{ Session::get('success') }}"/>
            @endif

            @if($errors->any())
                <x-alert type="danger" message="Se han producido errores:">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </x-alert>
            @endif




            <p><FIXME:1 calss="1">1.5_arreglar: LAR09</FIXME:1>
            Contamos con un catálogo de {{--$total--}} motos.</p>

            <!--yield mostrará la sección "contenido de la vista hija"-->
            @yield('contenido')



            <div class="btn-group" role="group" arial-label="Links">
                <!--define y muestra la sección enlaces -->
                @section('enlaces')
                    <a href="{{ url('/') }}" class="btn btn-primary m-2">Inicio</a>
                @show

            </div>
        </main>


        <!--PARTE INFERIOR-->
        @section('pie')
        <footer class="page-footer font-small p-4 bg-light">
            <p>Aplicación creada por <b>{{$autor}}</b> como ejemplo de clase.
                Desdarrollada haciendo usu de <b>Laravel</b> y <b>Bootstrap</b>.
            </p>
        </footer>
        @show



    </body>
</html>
