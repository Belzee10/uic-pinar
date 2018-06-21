@php($page='cursos')
@extends('frontend.main')
@section('title', 'Cursos')

@section('content')

<div class="container">
    <section id="mision">
        <h2 class="title wow fadeIn mb-4">
            {{$curso->nombre}}
        </h2>
        <dl class="row">
            <dt class="col-md-1">
                Costo de matrícula:
            </dt>
            <dd class="col-md-11">
                {{$curso->costo_matricula}} CUP
            </dd>

            <dt class="col-md-1">
                Lugar:
            </dt>
            <dd class="col-md-11">
                {{$curso->lugar}}
            </dd>

            <dt class="col-md-1">
                Fecha de inicio:
            </dt>
            <dd class="col-md-11">
                {{$curso->fecha_inicio->formatLocalized('%A %d %B %Y')}}
            </dd>

            <dt class="col-md-1">
                Capacidad:
            </dt>
            <dd class="col-md-11">
                {{$curso->capacidad}} Alumnos
            </dd>

            <dt class="col-md-1">
                Duración:
            </dt>
            <dd class="col-md-11">
                {{$curso->duracion}} Horas
            </dd>
            <dt class="col-md-1">
                Descripción:
            </dt>
            <dd class="col-md-5">
                {{$curso->descripcion}}
            </dd>
        </div>
        
    </section>
</div>

@endsection