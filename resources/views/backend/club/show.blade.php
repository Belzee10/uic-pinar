@php($page='clubes')
@extends('backend.main')
@section('title', 'Clubes')

@section('content')
<h4 class="titulo">Detalles del Club</h4>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">        
                <dl class="row">
                    <dt class="col-md-3">
                        Nombre:
                    </dt>
                    <dd class="col-md-9">
                        {{$club->nombre}}
                    </dd>
                    <dt class="col-md-12 mb-0">
                        Integrantes:
                    </dt>                    
                    @foreach ($club->usuarios as $user)
                        <dd class="col-md-9 offset-md-3">
                            {{$loop->iteration}} -
                            {{$user->nombre_completo}}                            
                            @if ($user->pivot->lider)
                            <span class="badge badge-light">
                                    <i class="mdi mdi-account-star-variant"></i>
                                Líder
                            </span>
                            @endif                            
                        </dd>
                    @endforeach
                    <dt class="col-md-3">
                        Descripción:
                    </dt>
                    <dd class="col-md-9">
                        {{$club->descripcion}}
                    </dd>
                </dl>    
                <a href="{{route('clubes.index')}}" class="btn btn-blue-grey">Volver al Listado</a>
            </div>
        </div>
    </div>
</div> 

@endsection