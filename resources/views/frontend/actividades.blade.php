@php($page='actividades')
@extends('frontend.main')
@section('title', 'Actividades')

@section('content')

<div class="container">
    <section id="actividades">
        <h2 class="title wow fadeIn mb-0">
            Actividades
        </h2>
        <hr class="mt-1 mb-4">
        <div class="row">
            <div class="col-md-6">
                <div class="row">                
                @foreach ($actividades as $act)
                    <div class="col-12">   
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{$act->tipo}}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                <i class="mdi mdi-clock"></i>
                                    {{$act->fecha->formatLocalized('%A %d %B %Y')}}
                                </h6>                                
                                <p class="card-text">
                                Responsable: {{$act->usuario->nombre_completo}}
                                </p>
                            </div>
                        </div>                        
                        @if (!$loop->last)
                            <hr class="mt-0 mb-0">
                        @endif
                        
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </section>
</div>

@endsection