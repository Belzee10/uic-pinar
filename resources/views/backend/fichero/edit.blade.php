@php($page='ficheros')
@extends('backend.main')
@section('title', 'Repositorio')

@section('content')
<h4 class="titulo">Editar fichero</h4>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{action('FicheroController@update', $fichero->id)}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <label for="fichero" class="grey-text">Fichero</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input{{ $errors->has('fichero') ? ' is-invalid' : '' }}" id="fichero" name="fichero" lang="es">
                            @if ($errors->has('fichero'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('fichero') }}</strong>
                                </span>
                            @endif
                            <label class="custom-file-label" for="fichero">
                                @if ($fichero->nombre)
                                    {{$fichero->nombre}}
                                @else
                                    Seleccionar fichero...
                                @endif
                        </div>
                    </div> 
                    <div class="form-group">
                        <input type="submit" value="Editar" class="btn btn-secondary" />
                        <a href="{{route('ficheros.index')}}" class="btn btn-blue-grey">Volver al Listado</a>
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