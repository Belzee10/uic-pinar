@php($page='cursos')
@extends('backend.main')
@section('title', 'Cursos')

@section('content')
<h4 class="titulo">Crear Curso</h4>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{action('CursoController@store')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="nombre" class="grey-text">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}">
                        @if ($errors->has('nombre'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="costo_matricula" class="grey-text">Costo de matrícula/CUP</label>
                        <input type="number" id="costo_matricula" name="costo_matricula" class="form-control{{ $errors->has('costo_matricula') ? ' is-invalid' : '' }}">
                        @if ($errors->has('costo_matricula'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('costo_matricula') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="lugar" class="grey-text">Lugar</label>
                        <input type="text" id="lugar" name="lugar" class="form-control{{ $errors->has('lugar') ? ' is-invalid' : '' }}">
                        @if ($errors->has('lugar'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('lugar') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="fecha_inicio" class="grey-text">Fecha de inicio</label>
                        <input id="fecha_inicio" name="fecha_inicio" class="form-control{{ $errors->has('fecha_inicio') ? ' is-invalid' : '' }}" width="230">
                        @if ($errors->has('fecha_inicio'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('fecha_inicio') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="capacidad" class="grey-text">Capacidad/Alumnos</label>
                        <input type="number" id="capacidad" name="capacidad" class="form-control{{ $errors->has('capacidad') ? ' is-invalid' : '' }}">                    
                        @if ($errors->has('capacidad'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('capacidad') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="duracion" class="grey-text">Duración/Horas</label>
                        <input type="number" id="duracion" name="duracion" class="form-control{{ $errors->has('duracion') ? ' is-invalid' : '' }}">
                        @if ($errors->has('duracion'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('duracion') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="usuario_id" class="grey-text">Profesor</label>
                        <select class="profesor form-control{{ $errors->has('usuario_id') ? ' is-invalid' : '' }}" name="usuario_id">
                            <option value=""></option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->nombre_completo}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('usuario_id'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('usuario_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="descripcion" class="grey-text">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                    </div> 
                      
                    <div class="form-group">
                        <input type="submit" value="Crear" class="btn btn-secondary" />
                        <a href="{{route('cursos.index')}}" class="btn btn-blue-grey">Volver al Listado</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        @include('flash::message')
    </div>
</div>

@endsection

@section('js')
    <script>
        $('.profesor').select2({
            language: "es"
        });
    </script>
    <script>
        $('#fecha_inicio').datepicker({
            uiLibrary: 'materialdesign',
            size: 'small',
            locale: 'es-es',
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection

