@php($page='cursos')
@extends('frontend.main')
@section('title', 'Cursos')

@section('content')

<div class="container">
    <section id="mision">
        <h2 class="title wow fadeIn mb-0">
            Solicitar inscripción a curso
        </h2>
        <hr class="mt-1 mb-4">
        <div class="row">            
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{action('FrontendController@participantesStore')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="nombre_completo" class="grey-text">Nombre y Apellidos</label>
                                <input type="text" id="nombre_completo" name="nombre_completo" class="form-control{{ $errors->has('nombre_completo') ? ' is-invalid' : '' }}">
                                @if ($errors->has('nombre_completo'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nombre_completo') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="ci" class="grey-text">Carnet de Identidad</label>
                                <input type="number" id="ci" name="ci" class="form-control{{ $errors->has('ci') ? ' is-invalid' : '' }}">                                
                                @if ($errors->has('ci'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('ci') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="correo" class="grey-text">Correo</label>
                                <input type="email" id="correo" name="correo" class="form-control{{ $errors->has('correo') ? ' is-invalid' : '' }}">
                                @if ($errors->has('correo'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('correo') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="telefono" class="grey-text">Teléfono</label>
                                <input type="number" id="telefono" name="telefono" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}">
                                @if ($errors->has('telefono'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input type="number" name="curso_id" hidden value="{{$curso_id}}" />

                            <div class="form-group">
                                <input type="submit" value="Solicitar" class="btn btn-secondary" />
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
</div>

@endsection