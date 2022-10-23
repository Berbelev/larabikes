@extends('layouts.master')

@section('titulo', 'Error 429')

@section('contenido')
        <div class="m-10">
            <div class="content" style="text-align: center">
                <div class='title mt-5' style="font-size: 3rem">
                    UPS... ERROR
                    <figure>
                        <img class="rounded" width="400px"
                             alt="Error 429"
                             src="{{asset('imagenes/errores/429.png')}}">
                    </figure>
                </div>
                <div class="title mb-5" style="font-size: 2rem">
                    {{ $exception->getMessage()}}
                </div>
            </div>
        </div>
@endsection

@section('enlaces')
    @parent
    <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
@endsection
