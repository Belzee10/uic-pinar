@php($page='organismos')
@extends('backend.main')
@section('title', 'Organismos')

@section('content')
<h4 class="titulo">Detalles del Organismo</h4>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">        
                <dl class="row">
                    <dt class="col-md-3">
                        Nombre:
                    </dt>
                    <dd class="col-md-9">
                        {{$organismo->nombre}}
                    </dd>
                    <dt class="col-md-12 mb-0">
                        Miembros:
                    </dt>       
                        @foreach ($users as $user)
                            <dd class="col-md-9 offset-md-3">   
                                {{$loop->iteration}} -
                                {{$user->nombre_completo}}   
                            </dd>                      
                        @endforeach                        
                                       
                </dl>    
                <a href="{{route('organismos.index')}}" class="btn btn-blue-grey">Volver al Listado</a>
            </div>
        </div>
    </div>
</div> 

@endsection