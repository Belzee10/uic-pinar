@php($page='users')
@extends('backend.main')
@section('title', 'Usuarios')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h4 class="titulo">Editar Usuario</h4>
    </div>
    <div class="offset-2 col-md-4">
        @include('flash::message')
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{action('UserController@update', $user->id)}}">
                    {{csrf_field()}}
                    {{ method_field('PATCH') }}
                    <h4>Datos personales</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre_completo" class="grey-text">Nombre y Apellidos</label>
                                <input type="text" id="nombre_completo" name="nombre_completo" value="{{$user->nombre_completo}}" class="form-control{{ $errors->has('nombre_completo') ? ' is-invalid' : '' }}">
                                @if ($errors->has('nombre_completo'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nombre_completo') }}</strong>
                                    </span>
                                @endif
                            </div> 
                        </div>                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="provincia_municipio" class="grey-text">Provincia/Municipio</label>
                                <select class="form-control{{ $errors->has('provincia_municipio') ? ' is-invalid' : '' }}" id="provincia_municipio" name="provincia_municipio">
                                </select>
                                @if ($errors->has('provincia_municipio'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('provincia_municipio') }}</strong>
                                    </span>
                                @endif
                                <div id="prov_munic_value" data-field-id="{{$user->provincia}}-{{$user->municipio}}" hidden></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono_personal" class="grey-text">Teléfono</label>
                                <input type="number" id="telefono_personal" name="telefono_personal" value="{{$user->telefono_personal}}" class="form-control{{ $errors->has('telefono_personal') ? ' is-invalid' : '' }}">
                                @if ($errors->has('telefono_personal'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('telefono_personal') }}</strong>
                                    </span>
                                @endif
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sexo" class="grey-text">Sexo</label>
                                <select class="form-control{{ $errors->has('sexo') ? ' is-invalid' : '' }}" id="sexo" name="sexo">
                                    <option @if($user->sexo == 'masculino') selected @endif value="masculino">Masculino</option>
                                    <option @if($user->sexo == 'femenino') selected @endif value="femenino">Femenino</option>
                                </select>
                                @if ($errors->has('sexo'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('sexo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ci" class="grey-text">Carnet de Identidad</label>
                                <input type="number" id="ci" name="ci" value="{{$user->ci}}" class="form-control{{ $errors->has('ci') ? ' is-invalid' : '' }}">
                                @if ($errors->has('ci'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('ci') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion_particular" class="grey-text">Dirección Particular</label>
                                <input type="text" id="direccion_particular" name="direccion_particular" value="{{$user->direccion_particular}}" class="form-control{{ $errors->has('direccion_particular') ? ' is-invalid' : '' }}">
                                @if ($errors->has('direccion_particular'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('direccion_particular') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="grey-text">Correo</label>
                                <input type="email" id="email" name="email" value="{{$user->email}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        
                    </div>
                    <h4 style="margin-top: 2rem">Datos profesionales</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="titulo_profesional" class="grey-text">Título obtenido</label>
                                <input type="text" id="titulo_profesional" name="titulo_profesional" value="{{$user->titulo_profesional}}" class="form-control{{ $errors->has('titulo_profesional') ? ' is-invalid' : '' }}">
                                @if ($errors->has('titulo_profesional'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('titulo_profesional') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ano_graduado" class="grey-text">Año graduado</label>
                                <select name="ano_graduado" id="ano_graduado" class="form-control{{ $errors->has('ano_graduado') ? ' is-invalid' : '' }}">
                                    @foreach ($years as $y)
                                        <option @if($user->ano_graduado == $y) selected @endif value="{{$y}}">{{$y}}</option>
                                    @endforeach                                    
                                </select>
                                @if ($errors->has('ano_graduado'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('ano_graduado') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label for="universidad" class="grey-text">Universidad</label>
                                <input type="text" id="universidad" name="universidad" value="{{$user->universidad}}" class="form-control{{ $errors->has('universidad') ? ' is-invalid' : '' }}">
                                @if ($errors->has('universidad'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('universidad') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        
                    </div>
                    <h4 style="margin-top: 2rem">Integración política</h4>
                    <hr>
                    <div class="row">
                        <div class="col">                        
                            @foreach ($integraciones_politicas as $key1 => $ip)
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" id="{{$ip->id}}" name="integ_politica[]" value="{{$ip->id}}" class="custom-control-input"                                    
                                        @foreach ($user->ips as $key2 => $user_ip)
                                            @if($key1 == $key2) checked @endif
                                        @endforeach                                        
                                    >
                                    <label class="custom-control-label" for="{{$ip->id}}">{{$ip->nombre}}</label>
                                </div>                                
                            @endforeach                            
                        </div>                        
                    </div>
                    <h4 style="margin-top: 2rem">Datos laborales</h4>
                    <hr>
                    <small style="margin-bottom: 10px" id="datos_laborales" class="form-text text-muted">
                        Centro de trabajo actual (si es jubilado, trabajador no estatal, o no trabaja, consígnelo así y señale el último Centro de Trabajo)
                    </small>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="centro_trabajo" class="grey-text">Centro de trabajo</label>
                                <input type="text" id="centro_trabajo" name="centro_trabajo" value="{{$user->centro_trabajo}}" class="form-control{{ $errors->has('centro_trabajo') ? ' is-invalid' : '' }}">
                                @if ($errors->has('centro_trabajo'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('centro_trabajo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="provincia_municipio_laboral" class="grey-text">Provincia/Municipio (Centro de trabajo)</label>
                                <select class="form-control{{ $errors->has('provincia_municipio_laboral') ? ' is-invalid' : '' }}" id="provincia_municipio_laboral" name="provincia_municipio_laboral">
                                </select>
                                @if ($errors->has('provincia_municipio_laboral'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('provincia_municipio_laboral') }}</strong>
                                    </span>
                                @endif
                                <div id="prov_munic_laboral_value" data-field-id="{{$user->provincia_laboral}}-{{$user->municipio_laboral}}" hidden></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="correo_laboral" class="grey-text">Correo (Centro de trabajo)</label>
                                <input type="email" id="correo_laboral" name="correo_laboral" value="{{$user->correo_laboral}}" class="form-control{{ $errors->has('correo_laboral') ? ' is-invalid' : '' }}">
                                @if ($errors->has('correo_laboral'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('correo_laboral') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="organismo" class="grey-text">Organismo al que pertenece</label>
                                <select class="form-control{{ $errors->has('organismo_id') ? ' is-invalid' : '' }}" id="organismo_id" name="organismo_id">
                                    @foreach ($organismos as $organismo)
                                        <option @if ($user->organismo_id == $organismo->id) selected @endif value="{{$organismo->id}}">{{$organismo->nombre}}</option>
                                    @endforeach                                    
                                </select>
                                @if ($errors->has('organismo_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('organismo_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direccion_laboral" class="grey-text">Dirección (Centro de trabajo)</label>
                                <input type="text" id="direccion_laboral" name="direccion_laboral" value="{{$user->direccion_laboral}}" class="form-control{{ $errors->has('direccion_laboral') ? ' is-invalid' : '' }}">
                                @if ($errors->has('direccion_laboral'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('direccion_laboral') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono_laboral" class="grey-text">Teléfono (Centro de trabajo)</label>
                                <input type="number" id="telefono_laboral" name="telefono_laboral" value="{{$user->telefono_laboral}}" class="form-control{{ $errors->has('telefono_laboral') ? ' is-invalid' : '' }}">
                                @if ($errors->has('telefono_laboral'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('telefono_laboral') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cargo_laboral" class="grey-text">Cargo que ocupa</label>
                                <input type="text" id="cargo_laboral" name="cargo_laboral" value="{{$user->cargo_laboral}}" class="form-control{{ $errors->has('cargo_laboral') ? ' is-invalid' : '' }}">
                                @if ($errors->has('cargo_laboral'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('cargo_laboral') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        
                    </div>
                    @if ($user->rol != 'admin')
                        <h4 style="margin-top: 2rem">Datos del usuario</h4>
                        <hr>                    
                        <div class="row">
                            <div class="col-md-6">                        
                                <div class="form-group">
                                    <label for="rol" class="grey-text">Rol</label>
                                    <select class="form-control{{ $errors->has('rol') ? ' is-invalid' : '' }}" id="rol" name="rol">
                                        <option @if($user->rol == 'miembro') selected @endif value="miembro">Miembro</option>
                                        <option @if($user->rol == 'directivo') selected @endif value="directivo">Directivo</option>
                                    </select>
                                    @if ($errors->has('rol'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('rol') }}</strong>
                                        </span>
                                    @endif
                                </div>                   
                            </div>
                            <div id="cargo_uic_div" class="col-md-6" @if($user->rol != 'directivo') style="display: none" @endif>                        
                                <div class="form-group">
                                    <label for="cargo_uic" class="grey-text">Cargo dentro de la UIC</label>
                                    <select class="form-control" id="cargo_uic" name="cargo_uic">
                                        {{--  <option value=""></option>  --}}
                                        <option @if($user->presidente) selected @endif value="presidente">Presidente</option>
                                        <option @if($user->vicepresidente) selected @endif value="vicepresidente">Vicepresidente</option>
                                        <option @if($user->vocal) selected @endif value="vocal">Vocal</option>
                                        <option @if($user->activista) selected @endif value="activista">Activista</option>
                                    </select>
                                </div>                   
                            </div>
                        </div>
                    @endif                   
                    
                    <div class="form-group">
                        <input type="submit" value="Editar" class="btn btn-secondary" />
                        <a href="{{route('users.index')}}" class="btn btn-blue-grey">Volver al Listado</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')   
   
    <script>
        $(document).ready(function () { 

            var prov_munic_value = $('#prov_munic_value').data("field-id");
            var prov_munic_laboral_value = $('#prov_munic_laboral_value').data("field-id");

            $.ajax({ 
                type: 'GET', 
                url: 'http://localhost/uic/public/data/data.json', 
                dataType: 'json',
                success: function (data) { 
                    $.each(data, function(i, element) { 
                        $('#provincia_municipio').append("<optgroup label='"+element.nombre+"'></optgroup>"); 
                        $('#provincia_municipio_laboral').append("<optgroup label='"+element.nombre+"'></optgroup>");                  
                        $.each(element.municipios, function(j, element1) {
                            if (prov_munic_value == element.nombre+"-"+element1) {
                                $('#provincia_municipio').append("<option selected value='"+element.nombre+"-"+element1+"'>"+element1+"</option>");
                            }
                            else {
                                $('#provincia_municipio').append("<option value='"+element.nombre+"-"+element1+"'>"+element1+"</option>");
                            }

                            if (prov_munic_laboral_value == element.nombre+"-"+element1) {
                                $('#provincia_municipio_laboral').append("<option selected value='"+element.nombre+"-"+element1+"'>"+element1+"</option>");
                            }
                            else {
                                $('#provincia_municipio_laboral').append("<option value='"+element.nombre+"-"+element1+"'>"+element1+"</option>");
                            }
                        });
                    });
                }
            });
        });      
    </script>
    
@endsection