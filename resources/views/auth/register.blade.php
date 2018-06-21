@php($page='register')
@extends('frontend.main')

@section('css')
    <link href="{{asset('backend/css/access.css')}}" rel="stylesheet">
@endsection

@section('content')
    <section id="register">
        <div class="container">
            <div class="card wow fadeIn">
                <div class="card-body">
                    <form method="POST" action="{{action('UserController@signup_store')}}">
                        {{csrf_field()}}
                        <h3 class="title">
                            Formulario de inscripción
                        </h3>
                        <h4 class="title">Datos personales</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_completo" class="grey-text">Nombre y Apellidos</label>
                                    <input type="text" id="nombre_completo" name="nombre_completo" class="form-control{{ $errors->has('nombre_completo') ? ' is-invalid' : '' }}">
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
                                        <option value=""></option>                                  
                                    </select>
                                    @if ($errors->has('provincia_municipio'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('provincia_municipio') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono_personal" class="grey-text">Teléfono</label>
                                    <input type="number" id="telefono_personal" name="telefono_personal" class="form-control{{ $errors->has('telefono_personal') ? ' is-invalid' : '' }}">
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
                                        <option value=""></option>
                                        <option value="masculino">Masculino</option>
                                        <option value="femenino">Femenino</option>
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
                                    <input type="number" id="ci" name="ci" class="form-control{{ $errors->has('ci') ? ' is-invalid' : '' }}">                                
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
                                    <input type="text" id="direccion_particular" name="direccion_particular" class="form-control{{ $errors->has('direccion_particular') ? ' is-invalid' : '' }}">
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
                                    <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}">
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
                                    <input type="text" id="titulo_profesional" name="titulo_profesional" class="form-control{{ $errors->has('titulo_profesional') ? ' is-invalid' : '' }}">
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
                                        <option value=""></option>                                    
                                        @foreach ($years as $y)
                                            <option value="{{$y}}">{{$y}}</option>
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
                                    <input type="text" id="universidad" name="universidad" class="form-control{{ $errors->has('universidad') ? ' is-invalid' : '' }}">
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
                                @foreach ($integracionespoliticas as $ip)
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" id="{{$ip->id}}" name="integ_politica[]" value="{{$ip->id}}" class="custom-control-input">
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
                                    <input type="text" id="centro_trabajo" name="centro_trabajo" class="form-control{{ $errors->has('centro_trabajo') ? ' is-invalid' : '' }}">
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
                                        <option value=""></option>                                    
                                    </select>
                                    @if ($errors->has('provincia_municipio_laboral'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('provincia_municipio_laboral') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="correo_laboral" class="grey-text">Correo (Centro de trabajo)</label>
                                    <input type="email" id="correo_laboral" name="correo_laboral" class="form-control{{ $errors->has('correo_laboral') ? ' is-invalid' : '' }}">
                                    @if ($errors->has('correo_laboral'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('correo_laboral') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>       
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="organismo_id" class="grey-text">Organismo al que pertenece</label>
                                    <select class="form-control{{ $errors->has('organismo_id') ? ' is-invalid' : '' }}" id="organismo_id" name="organismo_id">
                                        <option value=""></option>                                    
                                        @foreach ($organismos as $organismo)
                                            <option value="{{$organismo->id}}">{{$organismo->nombre}}</option>
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
                                    <input type="text" id="direccion_laboral" name="direccion_laboral" class="form-control{{ $errors->has('direccion_laboral') ? ' is-invalid' : '' }}">
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
                                    <input type="number" id="telefono_laboral" name="telefono_laboral" class="form-control{{ $errors->has('telefono_laboral') ? ' is-invalid' : '' }}">
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
                                    <input type="text" id="cargo_laboral" name="cargo_laboral" class="form-control{{ $errors->has('cargo_laboral') ? ' is-invalid' : '' }}">
                                    @if ($errors->has('cargo_laboral'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('cargo_laboral') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>  
                        </div>
                        <h4 style="margin-top: 2rem">Datos del usuario</h4>
                        <hr>     
                        <div class="row">
                            <div class="col-md-6">
                                <label for="password" class="grey-text">Contraseña</label>
                                <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                   

                        <div class="form-group">
                            <input type="submit" value="Enviar" class="btn btn-main" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </section>
@endsection

@section('js')        
    <script>
        $(document).ready(function () { 
            $.ajax({ 
                type: 'GET', 
                url: 'http://localhost/uic/public/data/data.json', 
                dataType: 'json',
                success: function (data) { 
                    $.each(data, function(i, element) { 
                        $('#provincia_municipio').append("<optgroup label='"+element.nombre+"'></optgroup>"); 
                        $('#provincia_municipio_laboral').append("<optgroup label='"+element.nombre+"'></optgroup>");                  
                        $.each(element.municipios, function(j, element1) {
                            $('#provincia_municipio').append("<option value='"+element.nombre+"-"+element1+"'>"+element1+"</option>");
                            $('#provincia_municipio_laboral').append("<option value='"+element.nombre+"-"+element1+"'>"+element1+"</option>");
                        });
                    });
                }
            });
        });      
    </script>
    
@endsection





