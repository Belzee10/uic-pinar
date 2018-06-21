@php($page='organismos')
@extends('backend.main')
@section('title', 'Organismos')

@section('content')

    <h4 class="titulo">Listado de Organismos</h4>

    <div class="card">
        <div class="card-body">
            <a href="{{route('organismos.create')}}" class="btn btn-secondary">Nuevo</a>

            <div class="table-responsive">
                <table class="table">
                    <thead class="blue-grey lighten-4">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Delegación Base</th>
                            <th class="text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($organismos as $org)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$org->nombre}}</td>
                            <td>                                
                                @if ($org->delegacionbase)
                                    {{$org->delegacionbase->nombre}}
                                @endif
                            </td>
                            <td class="text-right">
                                <a class="btn btn-info" href="{{route('organismos.show', $org->id)}}" title="Mostrar detalles">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                </a> 
                                <a class="btn btn-warning" href="{{route('organismos.edit', $org->id)}}" title="Editar">
                                    <i class="mdi mdi-pencil"></i>
                                </a>                               
                                <form action="organismos/{{ $org->id }}" method="post" class="delete">
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
            
            {{ $organismos->links() }}
        </div>
    </div>    
@endsection