@php($page='users')
@extends('backend.main')
@section('title', 'Usuarios')

@section('content')
<h4 class="titulo">Detalles del Usuario</h4>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">        
                <dl class="row">
                    <dt class="col-md-12">
                        <h4>Datos personales</h4>
                        <hr>
                    </dt>
                    <dt class="col-md-3">
                        Nombre:
                    </dt>
                    <dd class="col-md-9">
                        {{$user->nombre_completo}}
                    </dd>
                    <dt class="col-md-3">
                       Sexo:
                    </dt>       
                    <dd class="col-md-9">
                        {{$user->sexo}}
                    </dd>      
                    <dt class="col-md-3">
                        Fecha de nacimiento:
                    </dt>       
                    <dd class="col-md-9">
                        {{$user->fecha_nacimiento->formatLocalized('%A %d %B %Y')}}
                    </dd>     
                    <dt class="col-md-3">
                        Carnet de identidad:
                    </dt>       
                    <dd class="col-md-9">
                        {{$user->ci}}
                    </dd>     
                    <dt class="col-md-3">
                        Dirección particular:
                    </dt>       
                    <dd class="col-md-9">
                        {{$user->direccion_particular}}
                    </dd> 
                    <dt class="col-md-3">
                        Provincia:
                    </dt>       
                    <dd class="col-md-9">
                        {{$user->provincia}}
                    </dd>  
                    <dt class="col-md-3">
                        Municipio:
                    </dt>       
                    <dd class="col-md-9">
                        {{$user->municipio}}
                    </dd>
                    <dt class="col-md-3">
                        Teléfono personal:
                    </dt>       
                    <dd class="col-md-9">
                        {{$user->telefono_personal}}
                    </dd>
                    <dt class="col-md-3">
                        Correo:
                    </dt>       
                    <dd class="col-md-9">
                        {{$user->email}}
                    </dd> 
                    <dt class="col-md-12" style="margin-top: 1rem">
                        <h4>Datos profesionales</h4>
                        <hr>
                    </dt> 
                    <dt class="col-md-3">
                        Título profesional:
                    </dt>       
                    <dd class="col-md-9">
                        {{$user->titulo_profesional}}
                    </dd>
                    <dt class="col-md-3">
                        Universidad:
                    </dt>       
                    <dd class="col-md-9">
                        {{$user->universidad}}
                    </dd>
                    <dt class="col-md-3">
                        Año de graduado:
                    </dt>       
                    <dd class="col-md-9">
                        {{$user->ano_graduado}}
                    </dd>
                    <dt class="col-md-12" style="margin-top: 1rem">
                        <h4>Integración política</h4>
                        <hr>
                    </dt>
                    <dd class="col">
                        @foreach ($user->ips as $ip)
                            {{$ip->nombre}}@if (!$loop->last), @endif  
                        @endforeach
                    </dd>
                    <dt class="col-md-12" style="margin-top: 1rem">
                        <h4>Datos laborales</h4>
                        <hr>
                    </dt>
                    <dt class="col-md-3">
                        Centro de trabajo:
                    </dt>       
                    <dd class="col-md-9">
                        {{$user->centro_trabajo}}
                    </dd>
                    <dt class="col-md-3">
                        Dirección laboral:
                    </dt>       
                    <dd class="col-md-9">
                        {{$user->direccion_laboral}}
                    </dd>
                    <dt class="col-md-3">
                        Provincia laboral:
                    </dt>       
                    <dd class="col-md-9">
                        {{$user->provincia_laboral}}
                    </dd>
                    <dt class="col-md-3">
                        Municipio laboral:
                    </dt>       
                    <dd class="col-md-9">
                        {{$user->municipio_laboral}}
                    </dd>
                    <dt class="col-md-3">
                        Teléfono laboral:
                    </dt>       
                    <dd class="col-md-9">
                        {{$user->telefono_laboral}}
                    </dd>
                    <dt class="col-md-3">
                        Correo laboral:
                    </dt>       
                    <dd class="col-md-9">
                        {{$user->correo_laboral}}
                    </dd>
                    <dt class="col-md-3">
                        Cargo laboral:
                    </dt>       
                    <dd class="col-md-9">
                        {{$user->cargo_laboral}}
                    </dd>
                    <dt class="col-md-3">
                        Organismo:
                    </dt>       
                    <dd class="col-md-9">                        
                        @if ($user->organismo)
                            {{$user->organismo->nombre}}
                        @endif                        
                    </dd>
                    <dt class="col-md-12" style="margin-top: 1rem">
                        <h4>Datos del usuario</h4>
                        <hr>
                    </dt>
                    <dt class="col-md-3">
                        Rol:
                    </dt>       
                    <dd class="col-md-9">
                        <span style="font-size: 12px"
                            @if ($user->rol == 'admin')
                                class="badge badge-dark"
                            @elseif ($user->rol == 'directivo')
                                class="badge badge-secondary"
                            @elseif ($user->rol == 'miembro')
                                class="badge badge-light"
                            @endif>
                            {{$user->rol}}
                        </span>
                    </dd>
                    @if ($user->presidente or $user->vicepresidente or $user->vocal or $user->activista)
                        <dt class="col-md-3">
                            Cargo dentro de la UIC:
                        </dt>       
                        <dd class="col-md-9">
                            @if ($user->presidente)
                                Presidente
                            @elseif ($user->vicepresidente)
                                Vicepresidente
                            @elseif ($user->vocal)
                                Vocal
                            @elseif ($user->activista)
                                Activista
                            @endif                        
                        </dd>
                    @endif                    
                </dl>    
                <a href="{{route('users.index')}}" class="btn btn-blue-grey">Volver al Listado</a>
            </div>
        </div>
    </div>
</div> 

@endsection