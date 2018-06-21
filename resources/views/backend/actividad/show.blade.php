@php($page='actividades')
@extends('backend.main')
@section('title', 'Actividades')

@section('content')
<h4 class="titulo">Detalles de la Actividad</h4>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">        
                <dl class="row">
                    <dt class="col-md-3">
                        Tipo:
                    </dt>
                    <dd class="col-md-9">
                        {{$actividad->tipo}}
                    </dd>
                    <dt class="col-md-3">
                        Fecha:
                    </dt>
                    <dd class="col-md-9">
                        {{$actividad->fecha->formatLocalized('%A %d %B %Y')}}
                    </dd>
                    <dt class="col-md-3">
                        Estado:
                    </dt>
                    <dd class="col-md-9">
                        @if ($actividad->estado)
                            Cumplida
                        @else
                            no cumplida
                        @endif
                    </dd>
                    <dt class="col-md-3">
                        Responsable:
                    </dt>
                    <dd class="col-md-9">
                        {{$actividad->usuario->nombre_completo}}
                    </dd>
                    
                </dl>    
                <a href="{{route('actividades.index')}}" class="btn btn-blue-grey">Volver al Listado</a>
            </div>
        </div>
    </div>
</div> 

@endsection