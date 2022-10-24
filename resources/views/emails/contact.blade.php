<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <style>
            @php
                include 'css/bootstrap.min.css';
            @endphp


        </style>
    </head>
    <body class="container p-3">
        <header class="container row bg-light p-4 my-4">
            <figure class="img-fluid col-2">
                <img src="{{asset('images/Logos/Logo.png')}}" alt="logo">
            </figure>
        </header>
        <main>
            <h2>Mensaje recibido: {{$mensaje->asunto}}</h2>
            <p class="cursiva">De {{$mensaje->nombre}}
                <a href="mailto:{{$mensaje->email}}">&lt;{{$mensaje->email}}&gt;</a>
            </p>

            <p>{{$mensaje->mensaje}}</p>
        </main>
        <footer class="page-footer font-small p-4 bg-light">
            <p>Aplicación creada por {{$autor}} para {{$centro}}
                como ejemplo de clase.
                Desarrollada haciendo uso de <b>Laravel</b> y
                <b>Boostrap</b>.
            </p>
        </footer>

    </body>
</html>
