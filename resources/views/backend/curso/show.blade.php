@php($page='cursos')
@extends('backend.main')
@section('title', 'Cursos')

@section('content')
<h4 class="titulo">Detalles del Curso</h4>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">        
                <dl class="row">
                    <dt class="col-md-3">
                        Nombre:
                    </dt>
                    <dd class="col-md-9">
                        {{$curso->nombre}}
                    </dd>
                    <dt class="col-md-3">
                        Costo de matrícula:
                    </dt>
                    <dd class="col-md-9">
                        {{$curso->costo_matricula}} CUP
                    </dd>
                    <dt class="col-md-3">
                        Lugar:
                    </dt>
                    <dd class="col-md-9">
                        {{$curso->lugar}}
                    </dd>
                    <dt class="col-md-3">
                        Fecha de inicio:
                    </dt>
                    <dd class="col-md-9">
                        {{$curso->fecha_inicio->formatLocalized('%A %d %B %Y')}}
                    </dd>
                    <dt class="col-md-3">
                        Capacidad:
                    </dt>
                    <dd class="col-md-9">
                        {{$curso->capacidad}} Alumnos
                    </dd>
                    <dt class="col-md-3">
                        Duración:
                    </dt>
                    <dd class="col-md-9">
                        {{$curso->duracion}} Horas
                    </dd>
                    <dt class="col-md-3">
                        Descripción:
                    </dt>
                    <dd class="col-md-9">
                        {{$curso->descripcion}}
                    </dd>
                    <dt class="col-md-12 mb-0">
                        Participantes:
                    </dt> 
                    @foreach ($participantes as $p)
                        <dd class="col-md-9 offset-md-3">
                                {{$loop->iteration}} -
                                {{$p->nombre_completo}}                            
                        </dd>
                    @endforeach                                       
                </dl>    
                <a href="{{route('cursos.index')}}" class="btn btn-blue-grey">Volver al Listado</a>
            </div>
        </div>
    </div>
</div> 

@endsection