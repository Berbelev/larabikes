@extends('layouts.master')

@section('titulo', "Detalles de la moto $bike->marca $bike->modelo")

@section('contenido')
    <table class="table table-striped table-bordered">

        <tr>
            <th scope="row">ID</th>
            <td>{{$bike->marca}}</td>
        </tr>
        <tr>
            <th scope="row">Modelo </th>
            <td>{{$bike->modelo}}</td>
        </tr>
        <tr>
            <th scope="row">Kms</th>
            <td>{{$bike->kms}}</td>
        </tr>
        <tr>
            <th scope="row">Precio</th>
            <td>{{$bike->precio}}</td>
        </tr>
        @if ($bike->matriculada !== 1)

        <tr>
            <th scope="row">Matriculada </th>
            <td>{{$bike->matriculada ? 'SI': 'NO'}}</td>
        </tr>
        @endif

        @if ($bike->matriculada)
        <tr>
            <th scope="row">Matrícula </th>
            <td>{{$bike->matricula}}</td>
        </tr>
        @endif

        @if ($bike->color)
        <tr>
            <th scope="row">Color </th>
            <td style="background-color:{{$bike->color}}"
                >{{$bike->color}}</td>
        </tr>
        @endif
        <tr>
            <th scope="row">Imagen: </th>
            <td class="text-start">
                <img class="rounded" style="max-width: 400px"
                         alt="Imagen de {{$bike->marca}} {{$bike->modelo}}"
                         title="Imagen de {{$bike->marca}} {{$bike->modelo}}"
                         src="{{
                            $bike->imagen?
                            asset('storage/'.config('filesystems.bikesImageDir')).'/'.$bike->imagen:
                            asset('storage/'.config('filesystems.bikesImageDir')).'/'.'/default.jpg'
                         }}">
            </td>
        </tr>

    </table>
    <div class="text-end my-3">
        <div class="btn-group mx-2">
            <a class="mx-2" href="{{route('bikes.edit',$bike->id)}}">
            <img height="40" width="40" src="{{asset('imagenes/icons/update.png')}}"
            alt="Modificar" title="Modifiar"></a>

            <a class="mx-2" href="{{route('bikes.delete',$bike->id)}}">
            <img height="40" width="40" src="{{asset('imagenes/icons/delete.png')}}"
            alt="Borrar" title="Borrar"></a>
        </div>
    </div>
@endsection

@section('enlaces')
    @parent
    <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
@endsection
