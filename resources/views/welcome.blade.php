@php($pagina='portada')

@extends('layouts.master')

@section('titulo', 'Welcome Larabikes')

@section('contenido')
    <figure>
        <img class="row mt-2 mb-2 col-10 offset-1"
             alt="Moto de portada"
             src="{{asset('imagenes/bikes/portada.png')}}">
    </figure>
@endsection

@section('enlaces')
@endsection
