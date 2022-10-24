@extends('layouts.master')
@section('titulo', 'Mis Motos')

@section('contenido')
@if(!Auth::user())
    <div class="alert alert-danger" role="alert">
        {{ __('Debes estár identificado para acceder tu espacio personal') }}
        <a class="stretched-link">{{route('login')}}</a>
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
