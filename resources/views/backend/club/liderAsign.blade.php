@php($page='clubes')
@extends('backend.main')
@section('title', 'Asignar líder')

@section('content')
    <h4 class="titulo">Asignar líder al club: <em class="lead" style="font-size: 1.5rem; font-weight: 400">{{$club->nombre}}</em></h4>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{action('ClubController@liderAsignAction')}}">
                    {{csrf_field()}}             
                    <small style="margin-bottom: 10px" id="datos_laborales" class="form-text text-muted">
                        Seleccione el líder del club
                    </small>                          
                        <div class="form-group">
                            <label for="miembro_id" class="grey-text">Miembro</label>
                            <select class="form-control{{ $errors->has('miembro_id') ? ' is-invalid' : '' }}" id="miembro_id" name="miembro_id">
                                @foreach ($club->usuarios as $user)                                    
                                    @if ($user->pivot->lider)
                                        <option value="{{$user->id}}">{{$user->nombre_completo}}</option>
                                        @break
                                    @elseif (!$user->pivot->lider && $loop->last)                                    
                                        <option value""></option>
                                    @endif                                
                                @endforeach        
                                @foreach ($club->usuarios as $user)                                    
                                    @if (!$user->pivot->lider && $user->rol != 'directivo')
                                        <option value="{{$user->id}}">{{$user->nombre_completo}}</option>
                                    @endif                                      
                                @endforeach            
                            </select>
                            @if ($errors->has('miembro_id'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('miembro_id') }}</strong>
                                </span>
                            @endif
                            <input hidden value="{{$club->id}}" name="club_id"/>
                        </div>                       

                    <div class="form-group">
                        <input type="submit" value="Guardar" class="btn btn-secondary" />
                        <a href="{{route('clubes.index')}}" class="btn btn-blue-grey">Volver al Listado</a>
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