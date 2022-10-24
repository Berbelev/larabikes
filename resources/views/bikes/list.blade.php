@extends('layouts.master')

@section('titulo', 'Listado de motos')

@section('contenido')
    <!-- parte SUPERIOR de la zona CENTRAL-->
    <!-------------------------------------------------------------------->
    <div class="row">
        <!-- PAGINACIÓN-->
        <div class="col-6 text-start">{{$bikes->links()}}</div>


        @auth
            <!-- BOTON nueva moto-->
            <div class="col-6 text-end">
                <p>Nueva moto <a href="{{route('bikes.create')}}"
                    class="btn btn-success ml-2">+</a></p>
            </div>
        @endauth

    </div>
    <!------------------------------------------------------------------->


    <!-- FORMULARIO para la BUSQUEDA de motos search() -->
    <form method="GET" action="{{route('bikes.search')}}" class="col-6 row">

        <input name="marca" placeholder="Marca" type="text" maxlength="16"
                class="col form-control mr-2 mb-2"
                value="{{ $marca ?? ''}}">

        <input name="modelo" placeholder="Modelo" type="text" maxlength="16"
                class="col form-control mr-2 mb-2"
                value="{{ $modelo ?? ''}}">

        <button type="submit" class="col btn btn-primary mr-2 mb-2" >
            Buscar</button>

        <a  href="{{route('bikes.index')}}">
            <button type="button" class="col btn btn-primary mb-2">
                Quitar filtro
            </button>
        </a>
    </form>
    <!--------------------------------------------------------------------->

    <!-- listado de motos en la zona CENTRAL-->
    <table class="table table-striped table-bordered">
    @forelse($bikes as $bike)

        @if ($loop->first)
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Matricula</th>
                <th>Color</th>
                <th>Operaciones</th>
            </tr>
        @endif

            <tr>
                <td>{{$bike->id}}</td>
                <td class="text-center" style="max-width: 80px" >
                    <!--TODO:IMAGEN mejorar estilo para que sean aprox la misma altura para cada fila-->
                    <img class="rounded" style="max-width: 80%"
                         alt="Imagen de {{$bike->marca}} {{$bike->modelo}}"
                         title="Imagen de {{$bike->marca}} {{$bike->modelo}}"
                         src="{{
                            $bike->imagen?
                            asset('storage/'.config('filesystems.bikesImageDir')).'/'.$bike->imagen:
                            asset('storage/'.config('filesystems.bikesImageDir')).'/'.'/default.jpg'
                         }}">
                </td>
                <td>{{$bike->marca}}</td>
                <td>{{$bike->modelo}}</td>
                <td>{{$bike->matricula}}</td>
                <td style="background-color:{{$bike->color}}">{{$bike->color}}</td>
                <td class="text-center">
                    <a href="{{route('bikes.show',$bike->id)}}">
                        <img height="20" width="20" alt="Ver detalles" title="Ver detalles"
                             src="{{asset('imagenes/icons/show.png')}}">
                    </a>

                    @auth
                    <a href="{{route('bikes.edit',$bike->id)}}">
                        <img height="20" width="20" alt="Modificar" title="Modificar"
                             src="{{asset('imagenes/icons/update.png')}}">
                    </a>
                    <a href="{{route('bikes.delete',$bike->id)}}">
                        <img height="20" width="20" alt="Borrar" title="Borrar"
                             src="{{asset('imagenes/icons/delete.png')}}">
                    </a>
                    @endauth
                </td>
            </tr>

        @if ($loop->last)
            <tr>
                <td colspan="7">Mostrando {{sizeof($bikes)}} de {{$bikes->total()}}.</td>
            <tr>
        @endif
    @empty
        <tr>
            <td colspan="3">No hay motos para mostrar</td>
        </tr>
    @endforelse
    </table>
    <!---------------------------------------------------------------------->
@endsection

