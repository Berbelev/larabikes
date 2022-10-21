@extends('layouts.master')

@section('titulo', 'Actualizar Moto')

@section('contenido')
    <!-- Formulario de edición - falseo a valor PUT-->
    <form class="my-2 border p-5" method="POST" enctype="multipart/form-data"
            action="{{
                URL::temporarySignedRoute('bikes.update', now()->addMinutes(1),$bike->id)
                }}">

        {{csrf_field()}}
        <!-- por PUT-->
        <input name="_method" type="hidden" value="PUT">

        <!-- Marca-->
        <div class="form-group row">
            <label for="inputMarca" class="col-sm-2 col-form-label">Marca</label>
            <input name="marca" value="{{$bike->marca}}" type="text"
            class="up form-control col-sm-10" id="inputMarca"
            placeholder="Marca" maxlength="255" required >
        </div>

        <!-- Modelo-->
        <div class="form-group row">
            <label for="inputModelo" class="col-sm-2 col-form-label">Modelo</label>
            <input name="modelo" value="{{$bike->modelo}}" type="text"
            class="up form-control col-sm-10" id="inputModelo"
            placeholder="Modelo" maxlength="255" required >
        </div>

        <!-- Precio-->
        <div class="form-group row">
            <label for="inputPrecio" class="col-sm-2 col-form-label">Precio</label>
            <input name="precio" value="{{$bike->precio}}" type="number"
            class="up form-control col-sm-4" id="inputPrecio"
            min="0" step="0.01" required >
        </div>

        <!-- kms-->
        <div class="form-group row">
            <label for="inputkms" class="col-sm-2 col-form-label">Kms</label>
            <input name="kms" value="{{$bike->kms}}" type="number"
            class="up form-control col-sm-4" id="inputkms" required >
        </div>

        <!-- Actualización para la matrícula-->
        <div class="form-group row my-3">
            <div class="form-check col-sm-6">
                <input name="matriculada" type="checkbox" value="1" class="form-check-input"
                    id="chkMatriculada" {{$bike->matriculada? "checked": ""}}>
                <label for="chkMatriculada" class="form-check-label">Matriculada</label>
            </div>
            <div class="form-check col-sm-6">
                <label for="inputMatricula" class="col-sm-2 form-label">Matricula</label>
                <input name="matricula" type="text" class="up form-control"
                    id="inputMatricula" maxlength="7" value="{{$bike->matricula}}">

                <label for="confirmMatricula" class="col-sm-2 form-label">Repetir</label>
                <input name="matricula_confirmation" type="text" class="up form-control"
                     id="confirmMatricula" maxlength="7"
                     value="{{old('matricula_confirmation')}}">
            </div>

        </div>
        <script>
            inputMatricula.disabled = !chkMatriculada.checked;
            confirmMatricula.disabled = !chkMatriculada.checked;

            chkMatriculada.onchange = function(){
                inputMatricula.disabled = !chkMatriculada.checked;
                confirmMatricula.disabled = !chkMatriculada.checked;
            }
        </script>

        <!-- Actualización para el color-->
        <div class="form-group row">
            <div class="form-check col-sm-6">
                <input type="checkbox" class="form-check-input"
                    id="chkColor" {{$bike->color? 'checked': ''}}>
                <label for="chkColor" class="form-check-label">Indicar el color</label>
            </div>

            <div class="form-check col-sm-6">
                <label for="inputColor" class="col-sm-2 form-label">Color</label>
                <input name="color" type="color" class="up form-control form-control-color"
                    id="inputColor" value="{{$bike->color ?? '#ffffff'}}">
            </div>
        </div>
        <script>
            inputColor.disabled = !chkColor.checked;

            chkColor.onchange = function(){
            inputColor.disabled = !chkColor.checked;
            }
        </script>

        <!--Actualización para la imagen - subida de archivos-->
        <div class="form-group row my-3">
            <div class="col-sm-9">
                <!--Opciones para subir archivo-->
                    <!--Si hay imagen->Sustituir Imagen -->
                    <!--Si NO hay imagen->Añadir Imagen -->
                <label for="inputImagen" class="col-sm-2 col-form-label">
                    {{$bike->imagen?'Sustituir': 'Añadir'}} imagen
                </label>
                <input name="imagen" type="file" class="form-control-file"
                    id="inputImagen">

                @if ($bike->imagen)
                    <!-- Checkbox Eliminar Imagen-->
                    <div class="form-check my-3">
                        <label class="form-check-label" for="inputEliminar">
                            <input type="checkbox" class="form-check-input" name="eliminarimagen"
                                    id="inputEliminar" value="checkedValue" >
                        Eliminar imagen
                        </label>
                    </div>
                    <script>
                        // si se marca el checkbox eliminarimagen
                        inputEliminar.onchange =function(){
                            // desabilita el imput Sustituir Imagen
                            inputImagen.disabled=this.checked;
                        }
                    </script>
                @endif
            </div>

            <div class="col-sm-3">
                <label>Imagen actual :</label>
                <img class="rounded img-thumbnail my-3"
                    alt="Imagen de {{$bike->marca}} {{$bike->modelo}}"
                    title="Imagen de {{$bike->marca}} {{$bike->modelo}}"
                    src="{{
                            $bike->imagen?
                            asset('storage/'.config('filesystems.bikesImageDir')).'/'.$bike->imagen:
                            asset('storage/'.config('filesystems.bikesImageDir')).'/'.'/default.jpg'
                        }}">
            </div>
        </div>

        <div class="form-group row">
            <button type="submit" class="btn btn-success m-2 mt-5">Guardar</button>
            <button type="reset" class="btn btn-secondary m-2">Restablecer</button>
        </div>
    </form>

    <div class="text-end my-3">
        <div class="btn-group mx-2">
            <a class="mx-2" href="{{route('bikes.show',$bike->id)}}">
            <img height="40" width="40" src="{{asset('imagenes/icons/show.png')}}"
            alt="Detalles" title="Detalles"></a>

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
