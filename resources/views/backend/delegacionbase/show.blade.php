@php($page='delegacionesbase')
@extends('backend.main')
@section('title', 'Delegaciones Base')

@section('content')
<h4 class="titulo">Detalles de la Delegación Base</h4>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">        
                <dl class="row">
                    <dt class="col-md-3">
                        Nombre:
                    </dt>
                    <dd class="col-md-9">
                        {{$delegacionbase->nombre}}
                    </dd>
                    <dt class="col-md-3">
                        Presidente:
                    </dt>
                    <dd class="col-md-9">
                        @foreach ($cargos as $cargo)                                
                            @if ($cargo->tipo == 'presidente')
                                {{$cargo->usuario->nombre_completo}}
                            @endif                                
                        @endforeach 
                    </dd>
                    <dt class="col-md-3">
                        Vicepresidente:
                    </dt>
                    <dd class="col-md-9">
                        @foreach ($cargos as $cargo)                                
                            @if ($cargo->tipo == 'vicepresidente')
                                {{$cargo->usuario->nombre_completo}}
                            @endif                                
                        @endforeach 
                    </dd>
                    <dt class="col-md-3">
                        Tesorero:
                    </dt>
                    <dd class="col-md-9">
                        @foreach ($cargos as $cargo)                                
                            @if ($cargo->tipo == 'tesorero')
                                {{$cargo->usuario->nombre_completo}}
                            @endif                                
                        @endforeach 
                    </dd>
                    <dt class="col-md-12 mb-0">
                        Organismos:
                    </dt>                    
                    @foreach ($organismos as $organismo)
                        <dd class="col-md-9 offset-md-3">
                            {{$loop->iteration}} -
                            {{$organismo->nombre}}
                        </dd>
                    @endforeach
                </dl>    
                <a href="{{route('delegacionesbase.index')}}" class="btn btn-blue-grey">Volver al Listado</a>
            </div>
        </div>
    </div>
</div> 

@endsection