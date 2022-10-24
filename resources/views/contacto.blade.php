@extends('layouts.master')
@section('titulo','Contactar con LaraBikes')

<!--ZONA CENTRAL DE LA VISTA CONTACTO-->
@section('contenido')
    <div class="container row">
        <form class="col-7 my-2 border p-4"
              enctype="multipart/form-data"
              method="POST"
              action="{{route('contacto.mail')}}">

              <!--include a hidden CSRF token field in the form -->
              {{csrf_field()}}

            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <input name="email" type="email" class="up form-control"
                       id="inputEmail" placeholder="Email" maxlength="255" required
                       value="{{old('email')}}">
            </div>
            <div class="form-group row">
                <label for="inputNombre" class="col-sm-2 col-form-label">Nombre</label>
                <input name="nombre" type="text" class="up form-control"
                       id="inputNombre" placeholder="Nombre" maxlength="255" required
                       value="{{old('nombre')}}">
            </div>
            <div class="form-group row">
                <label for="inputAsunto" class="col-sm-2 col-form-label">Asunto</label>
                <input name="asunto" type="text" class="up form-control"
                       id="inputAsunto" placeholder="Asunto" maxlength="255" required
                       value="{{old('asunto')}}">
            </div>
            <div class="form-group row">
                <label for="inputMensaje" class="col-sm-2 col-form-label">Mensaje</label>
                <textarea name="mensaje"  class="up form-control"
                       id="inputMensaje"  maxlength="2048" required >{{old('mensaje')}}</textarea>
            </div>
            <div class="form-group row">
                <label for="inputFichero" class="form-label">Fichero (pdf): </label>
                <input name="fichero" type="file" class="form-control-file"
                       id="inputFichero"  accept="application/pdf">
            </div>

            <div class="form-group row">
                <button type="submit" class="btn btn-success m-2 mt-5">Enviar</button>
                <button type="reset" class="btn btn-secondary m-2 mt-5">Borrar</button>
            </div>
        </form>

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2985.647615286069!2d2.0558356155230975!3d41.55522649353615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a493650ae03931%3A0xee4ac6c8e8372532!2sCIFO%20Sabadell!5e0!3m2!1sca!2ses!4v1664980651177!5m2!1sca!2ses"
                style="min-witdth:300px; min-height:300px;" loading="lazy"
                class="col-5 my-2 border p-3"
                referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
@endsection

@section('enlaces')
            @parent
            <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
@endsection
