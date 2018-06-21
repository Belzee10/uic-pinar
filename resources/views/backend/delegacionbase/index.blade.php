@php($page='delegacionesbase')
@extends('backend.main')
@section('title', 'Delegaciones Base')

@section('content')

    <h4 class="titulo">Listado de Delegaciones Base</h4>

    <div class="card">
        <div class="card-body">
            <a href="{{route('delegacionesbase.create')}}" class="btn btn-secondary">Nuevo</a>

            <div class="table-responsive">
                <table class="table">
                    <thead class="blue-grey lighten-4">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>                            
                            <th class="text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($delegacionesbase as $db)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$db->nombre}}</td>                           
                            <td class="text-right">
                                <a class="btn btn-primary" href="{{route('cargoAsign', $db->id)}}" title="Asignar cargos">
                                    <i class="mdi mdi-account-star-variant"></i>
                                </a>
                                <a class="btn btn-info" href="{{route('delegacionesbase.show', $db->id)}}" title="Mostrar detalles">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                </a> 
                                <a class="btn btn-warning" href="{{route('delegacionesbase.edit', $db->id)}}" title="Editar">
                                    <i class="mdi mdi-pencil"></i>
                                </a>                               
                                <form action="delegacionesbase/{{ $db->id }}" method="post" class="delete">
                                    {{ method_field('DELETE') }}
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-danger" title="Eliminar">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>            
                    @endforeach
                    </tbody>
                </table> 
            </div> 

            {{ $delegacionesbase->links() }}            
        </div>
    </div>    
@endsection