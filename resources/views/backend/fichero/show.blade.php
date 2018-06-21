@php($page='ficheros')
@extends('backend.main')
@section('title', 'Repositorio')

@section('content')
<h4 class="titulo">Detalles del Fichero</h4>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">        
                <dl class="row">
                    <dt class="col-md-3">
                        Nombre:
                    </dt>
                    <dd class="col-md-9">
                        {{$fichero->nombre}}
                    </dd>
                    <dt class="col-md-3">
                        Tipo:
                    </dt>
                    <dd class="col-md-9">
                        {{$fichero->tipo}}
                    </dd>                   
                    <dt class="col-md-3">
                        Enlace de descarga:
                    </dt>
                    <dd class="col-md-9">
                        <a href="{{route('download', $fichero->id)}}" class="download" title="Descargar">
                            <i class="mdi mdi-download"></i>
                            Descargar
                        </a>
                    </dd>
                </dl>    
                <a href="{{route('ficheros.index')}}" class="btn btn-blue-grey">Volver al Listado</a>
            </div>
        </div>
    </div>
</div> 

@endsection