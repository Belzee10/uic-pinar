@php($page='planilla_solicitud')
@extends('backend.main')
@section('title', 'Reportes - Listado de miembros')

@section('content')
<h4 class="titulo">Listado de miembros UIC - Exportar planilla de solicitud de ingreso</h4>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">                            
                <div class="table-responsive">
                    <table class="table">
                        <thead class="blue-grey lighten-4">
                            <tr>
                                <th>Nombre y apellidos</th>
                                <th>No. CI</th>
                                <th>Provincia</th>
                                <th>Municipio</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Exportar</th>                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->nombre_completo}}</td>
                                <td>{{$user->ci}}</td>
                                <td>{{$user->provincia}}</td>
                                <td>{{$user->municipio}}</td>
                                <td>{{$user->telefono_personal}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <a class="btn btn-planilla" href="{{route('planilla_solicitud_word', $user->id)}}" title="Exportar planilla de ingreso">
                                        Exportar planilla
                                    </a>
                                </td>
                            </tr>            
                        @endforeach
                        </tbody>
                    </table> 
                </div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div> 

@endsection