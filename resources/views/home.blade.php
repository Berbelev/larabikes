@extends('layouts.master')
@section('titulo', 'Mis Motos')


@section('contenido')
@if(!Auth::user())
    <div class="alert alert-danger" role="alert">
        {{ __('Debes estár identificado para acceder tu espacio personal') }}
        <a class="stretched-link">{{route('login')}}</a>
    </div>
@endif

@if (session('resent'))
<div class="alert alert-success" role="alert">
    {{ __('Hemos enviado un nuevo link de verificación a tu correo electrónico.') }}
</div>
@endif

<!--Si el usuario no ha verificado su email-->
@if(empty(Auth::user()->email_verified_at))
    <!--Alertarle de que realice la operación-->
    <div class="alert alert-danger" role="alert">
        {{ __('Antes de continuar, por favor, confirme su correo electrónico con el enlace de verificación que le fue enviado. Si no ha recibido el correo electrónco') }}
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('haga clic aquí para solicitar otro.') }}</button>.
        </form>
    </div>
@endif


    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">{{ __('Mi Perfil') }}
                </div>
                    <div class="card-body">
                        @auth
                            @if(Auth::user())
                            {{__('Identificado correctamente')}}
                            <br>
                            <table class="table table-borderless">
                                <tr>
                                    <th >Usuario Identificado: </th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th scope="row">Nombre:</th>
                                    <td>{{Auth::user()->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">e-mail:</th>
                                    <td>{{Auth::user()->email}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Verificación del e-mail:</th>
                                    <td>{{Auth::user()->email_verified_at? 'Verificado' : 'Pendiente'}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Fecha de creación:</th>
                                    <td>{{Auth::user()->created_at}}</td>
                                </tr>

                            </table>
                            @endif
                        @endauth
                    </div>
            </div>
        </div>
    </div>
    <br>
    <!--------------------------------------------------------------------->
    <!--LISTADO DE MIS MOTOS-->
    <!--------------------------------------------------------------------->
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
                        <!--TODO:LAR.IMAGEN mejorar estilo para que sean aprox la misma altura para cada fila-->
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
                            @if(Auth::user()->can('update',$bike))
                                <a href="{{route('bikes.edit',$bike->id)}}">
                                    <img height="20" width="20" alt="Modificar" title="Modificar"
                                        src="{{asset('imagenes/icons/update.png')}}">
                                </a>
                            @endif

                            @if(Auth::user()->can('delete', $bike))
                                <a href="{{route('bikes.delete',$bike->id)}}">
                                    <img height="20" width="20" alt="Borrar" title="Borrar"
                                        src="{{asset('imagenes/icons/delete.png')}}">
                                </a>
                            @endif
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
