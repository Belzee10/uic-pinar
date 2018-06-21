@php($page='actividades')
@extends('backend.main')
@section('title', 'Actividades')

@section('content')
<h4 class="titulo">Crear Actividad</h4>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{action('ActividadController@store')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="tipo" class="grey-text">Tipo</label>
                        <select class="form-control{{ $errors->has('tipo') ? ' is-invalid' : '' }}" name="tipo">
                            <option value=""></option>
                            <option value="evento">Evento</option>
                            <option value="reunion">Reunión</option>
                        </select>
                        @if ($errors->has('tipo'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('tipo') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="fecha" class="grey-text">Fecha</label>
                        <input id="fecha" name="fecha" class="form-control{{ $errors->has('fecha') ? ' is-invalid' : '' }}" width="230">
                        @if ($errors->has('fecha'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('fecha') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="estado" class="grey-text">Estado</label>
                        <select class="form-control{{ $errors->has('estado') ? ' is-invalid' : '' }}" name="estado">
                            <option value=""></option>
                            <option value="1">Cumplida</option>
                            <option value="0">No cumplida</option>
                        </select>
                        @if ($errors->has('estado'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('estado') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="usuario_id" class="grey-text">Responsable</label>
                        <select class="form-control responsable{{ $errors->has('usuario_id') ? ' is-invalid' : '' }}" name="usuario_id">
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
                        <input type="submit" value="Crear" class="btn btn-secondary" />
                        <a href="{{route('actividades.index')}}" class="btn btn-blue-grey">Volver al Listado</a>
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
        $('.responsable').select2({
            language: "es"
        });
    </script>
    <script>
        $('#fecha').datepicker({
            uiLibrary: 'materialdesign',
            size: 'small',
            locale: 'es-es',
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection