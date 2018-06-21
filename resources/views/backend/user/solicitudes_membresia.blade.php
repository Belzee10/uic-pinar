@php($page='solicitudes_membresia')
@extends('backend.main')
@section('title', 'Solicitudes de membresía')

@section('content')

    <h4 class="titulo">Solicitudes de membresía</h4>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="blue-grey lighten-4">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Provincia</th>
                            <th>Municipio</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th class="text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                     @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$user->nombre_completo}}</td>
                            <td>{{$user->provincia}}</td>
                            <td>{{$user->municipio}}</td>
                            <td>{{$user->telefono_personal}}</td>
                            <td>{{$user->email}}</td>                           
                            <td class="text-right">
                                <a class="btn btn-info" href="{{route('detalles', $user->id)}}" title="Mostrar detalles">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                </a> 
                                <a class="btn btn-success" href="{{route('aceptar_solicitud', $user->id)}}" title="Aceptar">
                                    <i class="mdi mdi-check"></i>
                                </a>
                                <a class="btn btn-danger" href="{{route('rechazar_solicitud', $user->id)}}" title="Rechazar">
                                    <i class="mdi mdi-close"></i>
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
@endsection