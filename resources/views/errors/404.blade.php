@extends('layouts.master')

@section('titulo', 'Error 404')

@section('contenido')
        <div class="m-10">
            <div class="content" style="text-align: center">
                <div class='title mt-5' style="font-size: 3rem">
                    Uh-Oh.... !:)
                    <figure>
                        <img class="rounded" width="400px"
                            alt="Error 404"
                            src="{{asset('imagenes/errores/404.jpeg')}}">
                    </figure>
                </div>

                <div class="title mb-5" style="font-size: 2rem">
                    <p>Pagina no encontrada.</p>
                    {{ $exception->getMessage()}}
                    <!--TODO:LAR32?Traducir mensajes de error-->
                </div>
            </div>
        </div>
@endsection

@section('enlaces')
    @parent
    <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
@endsection
