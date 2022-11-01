<!DOCTYPE html>
<html lang='es'>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-sacale=1">

        <meta name="description" content="Ejemplo CRUD con laravel - Larabikes">

            <!-- CSRF Token -->
            <meta name="csrf-token" content="{{ csrf_token() }}">


        <!-- yield mostrará el contenido de la sección titulo que se especificará en la vista hija-->
        <title>{{config('app.name')}} - @yield('titulo')</title>

        <!-- CSS para Bootstrap-->
        <script src="{{ asset('js/bootstrap.min.js')}}" defer></script>
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


        <!-- FAVICON-->
        <link rel="shortcut icon" href="{{config('app.favicon')}}" type="image/png">
    </head>
    <body class="container p-3">
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <figure>
                        <a class="navbar-brand"
                        href="{{route('portada')}}">
                            <img id="inicio" alt="logo larabaikes"
                                src="{{asset(config('app.favicon'))}}"
                                width="100">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </figure>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                            <li class="nav-item">
                                <div class="row">
                                    <div class="col">
                                        <a id="navbarDropdown" class="nav-link" href="{{route('home')}}" role="button">
                                            {{ Auth::user()->name }} ({{ Auth::user()->email }})
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a  class="nav-link"  href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </div>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>



        <!--PARTE SUPERIOR-->

        <!--MENSAJES condicionados al entorno-->
        @env(['local', 'test'])
            <x-local :mode="App::environment()" />
        @endenv
        @env(['staging', 'production'])
            <x-production/>
        @endenv

        <!--NAVEGADOR sección-->
        @section('navegacion')
        @php($pagina = Route::currentRouteName())

        <nav>
            <ul class="nav nav-pills flex-column flex-sm-row my-3">
                <li class="nav-item mr-2">
                    <figure>
                        <a clas="nav-link {{$pagina=='portada'
                                            ? 'active':''}}"
                        href="{{route('portada')}}">
                            <img id="inicio" alt="logo larabaikes"
                                src="{{asset(config('app.favicon'))}}"
                                width="70">
                        </a>
                    </figure>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link {{$pagina=='bikes.index'||
                                        $pagina=='bikes.search'?'active':''}}"
                    href="{{route('bikes.index')}}">Garaje</a>
                </li>

                @guest
                <li class="nav-item">
                    <a class="nav-link {{$pagina=='register'?'active':''}}"
                     href="{{route('register')}}">Registro</a>
                </li>
                @endguest


                <!--Muestra nueva moto solo para usuarios ifentificados-->
                @auth
                <li class="nav-item">
                    <a class="nav-link {{$pagina=='home'?'active':''}}"
                     href="{{route('home')}}">Mis Motos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{$pagina=='bikes.create'?'active':''}}"
                     href="{{route('bikes.create')}}">Nueva Moto</a>
                </li>
                @if(Auth::user()->hasRole('administrador'))
                    <li class="nav-item mr-2">
                        <a class="nav-link {{$pagina=='bikes.deleted.bikes'?'active':''}}"
                        href="{{route('admin.deleted.bikes')}}">Motos Borradas</a>
                    </li>
                @endif
                @endauth
                <li class="nav-item mr-2">
                    <a class="nav-link {{$pagina=='contacto' ? 'active' : ''}}"
                     href="{{route('contacto')}}">Contacto</a>
               </li>
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




            <p>
            Contamos con un catálogo de {{ $total ?? '' }} motos.</p>

            <!--yield mostrará la sección "contenido de la vista hija"--------------------->
            @yield('contenido')



            <div class="btn-group" role="group" arial-label="Links">

                <!--define y muestra la sección enlaces ------------------------------------>
                @section('enlaces')
                    <a href="{{ url()->previous() }}" class="btn btn-primary m-2">Atrás</a>
                    <a href="{{ route('portada') }}" class="btn btn-primary m-2">Inicio</a>
                @show

            </div>
        </main>


        <!--PARTE INFERIOR---------------------------------------------------------------------->
        @section('pie')
        <footer class="page-footer font-small p-4 bg-light">
            <p>Aplicación creada por <b>{{$autor}}</b> como ejemplo de clase.
                Desarrollada haciendo uso de <b>Laravel</b> y <b>Bootstrap</b>.
            </p>
        </footer>
        @show



    </body>
</html>
