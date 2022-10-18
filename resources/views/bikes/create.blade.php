@extends('layouts.master')

@section('titulo', 'Nueva Moto ')

@section('contenido')
    <form class="my-2 border p-5" method="POST" action="{{route('bikes.store')}}">
        {{csrf_field()}}
        <div class="form-group row">
            <label for="inputMarca" class="col-sm-2 col-form-label">
            Marca</label>
            <input name="marca" type="text" class="up form-control col-sm-10"
                   id="inputMarca" placeholder="Marca" maxlenght="255" required
                   value="{{old('marca')}}">
        </div>
        <div class="form-group row">
            <label for="inputModelo" class="col-sm-2 col-form-label">
            Modelo</label>
            <input name="modelo" type="text" class="up form-control col-sm-10"
                   id="inputModelo" placeholder="Modelo" maxlenght="255" required
                   value="{{old('modelo')}}">
        </div>
        <div class="form-group row">
            <label for="inputKms" class="col-sm-2 col-form-label">
            Kms</label>
            <input name="kms" type="number" class="up form-control col-sm-4"
                   id="inputKms"  required  value="{{old('kms')}}">
        </div>
        <div class="form-group row">
            <label for="inputPrecio" class="col-sm-2 col-form-label">
            Precio</label>
            <input name="precio" type="number" class="up form-control col-sm-4"
                   id="inputPrecio"  maxlenght="11" min="0" step="0.1" required
                   value="{{old('precio')}}">
        </div>
        <!-- Actualización para la matrícula-->
        <div class="form-group row my-3">
            <div class="form-check col-sm-6">
                <input id="chkMatriculada" type="checkbox" value="1" name="matriculada"
                       class="form-check-input"
                       {{empty(old('matriculada'))? "" : "checked"}}>
                <label for="chkMatriculada" class="form-check-label">Matriculada</label>
            </div>
            <div class="form-check col-sm-6">
                <label for="inputMatricula" class="col-sm-2 form-label">Matrícula</label>
                <input name="matricula" type="text" class="up form-control"
                       id="inputMatricula" maxlength="7"
                       value="{{old('matricula')}}">

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
        <div class="form-group row my-3">
            <div class="form-check col-sm-6">
                <input type="checkbox"   class="form-check-input" id="chkColor">
                <label for="chkColor" class="form-check-label">Indicar el color</label>
            </div>
            <div class="form-check col-sm-6">
                <label for="inputColor" class="col-sm-2 form-label">Color</label>
                <input name="color" type="color" class="up form-control form-control-color"
                       id="inputColor"
                       value="{{old('color')?? '#FFFFFF'}}">
            </div>
        </div>
        <script>
            inputColor.disabled = !chkColor.checked;

            chkColor.onchange = function(){
                inputColor.disabled = !chkColor.checked;
            }
        </script>
        <div class="form-group row">
            <button type="submit" class="btn btn-success m-2 mt-5">Guardar</button>
            <button type="reset" class="btn btn-secondary m-2">Borrar</button>
        </div>
    </form>
@endsection

@section('enlaces')
    @parent
    <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
@endsection

