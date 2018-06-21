@php($page='clubes')
@extends('frontend.main')
@section('title', 'Clubes')

@section('content')

<div class="container">
    <section id="clubes">
        <h2 class="title wow fadeIn mb-0">
            Clubes
        </h2>
        <hr class="mt-1 mb-4">
        <div class="row">            
            @foreach ($clubes as $club)
                <div class="col-md-3">
                    <div class="card text-center">                    
                    @if ($club->simbolo)
                        <img class="card-img-top" src="{{asset('clubes_simbolos/'.$club->nombre_simbolo)}}" alt="Club">
                    @else                    
                        <img class="card-img-top" src="{{asset('frontend/img/icons/default-club.png')}}" alt="Club">
                    @endif
                        <div class="card-body">
                            <h5 class="card-title">{{$club->nombre}}</h5>
                            <p class="card-text">
                                {{str_limit($club->descripcion, 160)}}
                            </p>
                            {{--  <a href="#" class="btn btn-primary">Go somewhere</a>  --}}
                        </div>
                    </div>
                </div>
            @endforeach            
        </div>
        
    </section>
</div>

@endsection