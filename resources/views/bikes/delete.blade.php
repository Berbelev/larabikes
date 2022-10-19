@extends('layouts.master')

@section('titulo', "Borrado de la moto $bike->marca $bike->modelo")

@section('contenido')
    <!-- Formulario de confirmación de eliminación - falseo a valor DELETE-->
    <form class="my-2 border p-5" method="POST"
          action="{{URL::signedRoute('bikes.destroy', $bike->id)}}">

        {{csrf_field()}}
        <input name="_method" type="hidden" value="DELETE">


        <label for="confirmdelete">Confirmar el borrado de {{"$bike->marca $bike->modelo"}}</label>
        <input type="submit" class="btn btn-danger m-4" alt="Borrar" title="Borrar"
            value="Borrar" id="confirmdelete">
    </form>
<!-- FIN DE LA SECCIÓN "contenido"-->
@endsection

@section('enlaces')
    <!-- Amplia la sección de enlaces con lista de motos-->
    @parent
        <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
        <a href="{{route('bikes.show',$bike->id)}}" class="btn btn-primary m-2">
            Regresar a detalles de la moto</a>
    <!-- FIN SECCIÓN "enlaces"-->
@endsection
