@php($page='delegacionesbase')
@extends('backend.main')
@section('title', 'Asignar cargos')

@section('content')
    <h4 class="titulo">Asignar cargos a la Delegación Base: <em class="lead" style="font-size: 1.5rem; font-weight: 400">{{$delegacion_base->nombre}}</em></h4>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <dl class="row">
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
                    </dl>
                    <hr>

                    <form method="POST" action="{{action('DelegacionBaseController@cargoAsignAction')}}">
                    {{csrf_field()}}            
                    
                    <div class="form-group">
                        <label for="tipo" class="grey-text">Tipo de cargo</label>
                        <select class="form-control{{ $errors->has('tipo') ? ' is-invalid' : '' }}" name="tipo" id="tipo">
                            <option value=""></option>
                            <option value="presidente">Presidente</option>
                            <option value="vicepresidente">Vicepresidente</option>
                            <option value="tesorero">Tesorero</option>
                        </select>
                        @if ($errors->has('tipo'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('tipo') }}</strong>
                            </span>
                        @endif
                    </div>    
                    <div id="miembros_deleg" class="form-group">
                        <label for="usuario_id" class="grey-text">Seleccione el miembro</label>
                        <select class="form-control{{ $errors->has('usuario_id') ? ' is-invalid' : '' }}" name="usuario_id" id="usuario_id">
                            <option value=""></option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->nombre_completo}}</option>
                            @endforeach                                                        
                        </select>
                        @if ($errors->has('usuario_id'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('usuario_id') }}</strong>
                            </span>
                        @endif
                        <input hidden value="{{$delegacion_base->id}}" name="delegacionbase_id"/>
                    </div> 

                    <div class="form-group">
                        <input type="submit" value="Guardar" class="btn btn-secondary" />
                        <a href="{{route('delegacionesbase.index')}}" class="btn btn-blue-grey">Volver al Listado</a>
                    </div>
                </form>   
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            @include('flash::message')
        </div>
    </div>

@endsection

@section('js')
    <script>
        $('#usuario_id').select2({
            language: "es"
        });
    </script>    
@endsection