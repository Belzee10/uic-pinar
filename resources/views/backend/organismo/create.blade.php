@php($page='organismos')
@extends('backend.main')
@section('title', 'Organismos')

@section('content')
<h4 class="titulo">Crear Organismo</h4>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{action('OrganismoController@store')}}">
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
                        <input type="submit" value="Crear" class="btn btn-secondary" />
                        <a href="{{route('organismos.index')}}" class="btn btn-blue-grey">Volver al Listado</a>
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