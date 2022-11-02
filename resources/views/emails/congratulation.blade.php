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
                <img src="{{asset('imagenes/template/logo.png')}}" alt="logo">
            </figure>
        </header>
        <main>
            <h1>Felicidades</h1>
            <h2>Has publicado tu primera moto en LaraBikes!</h2>
            <p>
                Tu nueva moto {{$bike->marca.' '.$bike->modelo}} ya
                aparece en los resultados.
            </p>
            <p>
                Sigue así, estás colaborando para que LaraBikes
                se convierta en la primera red de usuarios de
                motocicletas de los CIFO.
            </p>
        </main>
        <footer class="page-footer font-small p-4 bg-light">
            <p>
                Aplicación creada por {{$autor}} como ejemplo de clase.
            </p>
            <p>
                Desarrollada haciendo uso de <b>Laravel</b> y <b>Boostrap</b>.
            </p>
        </footer>

    </body>
</html>
