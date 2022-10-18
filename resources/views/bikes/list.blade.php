@extends('layouts.master')

@section('titulo', 'Listado de motos')

@section('contenido')
    <!-- parte SUPERIOR de la zona CENTRAL-->
    <div class="row">
        <!-- PAGINACIÓN-->
        <div class="col-6 text-start">{{$bikes->links()}}</div>
        <!-- BOTON nueva moto-->
        <div class="col-6 text-end">
            <p>Nueva moto <a href="{{route('bikes.create')}}"
                class="btn btn-success ml-2">+</a></p>
        </div>
    </div>

    <!-- listado de motos en la zona CENTRAL-->
    <table class="table table-striped table-bordered">
    @forelse($bikes as $bike)

        @if ($loop->first)
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Operaciones</th>
            </tr>
        @endif

            <tr>
                <td>{{$bike->id}}</td>
                <td>{{$bike->marca}}</td>
                <td>{{$bike->modelo}}</td>
                <td class="text-center">
                    <a href="{{route('bikes.show',$bike->id)}}">
                        <img height="20" width="20" alt="Ver detalles" title="Ver detalles"
                             src="{{asset('imagenes/icons/show.png')}}">
                    </a>
                    <a href="{{route('bikes.edit',$bike->id)}}">
                        <img height="20" width="20" alt="Modificar" title="Modificar"
                             src="{{asset('imagenes/icons/update.png')}}">
                    </a>
                    <a href="{{route('bikes.delete',$bike->id)}}">
                        <img height="20" width="20" alt="Borrar" title="Borrar"
                             src="{{asset('imagenes/icons/delete.png')}}">
                    </a>
                </td>
            </tr>

        @if ($loop->last)
            <tr>
                <td colspan="4">Mostrando {{sizeof($bikes)}} de {{$total ?? ''}}.</td>
            <tr>
        @endif
    @empty
        <tr>
            <td colspan="3">No hay motos para mostrar</td>
        </tr>
    @endforelse
    </table>

@endsection

