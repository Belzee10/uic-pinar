@php($page='listado_miembros')
@extends('backend.main')
@section('title', 'Reportes - Listado de miembros')

@section('content')
<h4 class="titulo">Listado de miembros UIC</h4>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                    <a href="{{route('listado_miembros_excel')}}" class="btn btn-excel">
                        Exportar a excel
                    </a>        
                <div class="table-responsive">
                    <table class="table">
                        <thead class="blue-grey lighten-4">
                            <tr>
                                <th>Nombre y apellidos</th>
                                <th>Sexo</th>
                                <th>No. CI</th>
                                <th>Fecha Nac.</th>
                                <th>Dir. Particular</th>
                                <th>Provincia</th>
                                <th>Municipio</th>
                                <th>Teléfono</th>
                                <th>Correo</th>                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->nombre_completo}}</td>
                                <td>{{$user->sexo}}</td>
                                <td>{{$user->ci}}</td>
                                <td>{{$user->fecha_nacimiento->formatLocalized('%A %d %B %Y')}}</td>
                                <td>{{$user->direccion_particular}}</td>
                                <td>{{$user->provincia}}</td>
                                <td>{{$user->municipio}}</td>
                                <td>{{$user->telefono_personal}}</td>
                                <td>{{$user->email}}</td>
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