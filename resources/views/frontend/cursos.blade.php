@php($page='cursos')
@extends('frontend.main')
@section('title', 'Cursos')

@section('content')

<div class="container">
    <section id="mision">
        <h2 class="title wow fadeIn mb-0">
            Cursos disponibles
        </h2>
        <hr class="mt-1 mb-4">
        <div class="row">            
            @foreach ($cursos as $curso)
                <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$curso->nombre}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">${{$curso->costo_matricula}}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">{{$curso->fecha_inicio->formatLocalized('%A %d %B %Y')}}</h6>
                        <p class="card-text">
                            {{str_limit($curso->descripcion, 160)}}
                        </p>                                         
                        @if ($curso->participante)
                            <a href="{{ route('curso_des_apuntarse', $curso->id) }}" class="card-link text-secondary">
                                No me interesa
                            </a> 
                        @else
                            <a href="{{ route('curso_apuntarse', $curso->id) }}" class="card-link text-secondary">
                                Me interesa
                            </a> 
                        @endif
                        <a href="{{ route('detalle_curso', $curso->id) }}" class="card-link">Detalles</a>
                    </div>
                </div>
                </div>
            @endforeach
        </div>
        
    </section>
</div>

@endsection