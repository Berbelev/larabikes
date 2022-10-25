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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mi Perfil') }}</div>

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
</div>
@endsection
