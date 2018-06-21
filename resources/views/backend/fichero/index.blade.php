@php($page='ficheros')
@extends('backend.main')
@section('title', 'Repositorio')

@section('content')

    <h4 class="titulo">Repositorio</h4>

    <div class="card">
        <div class="card-body">
            <a href="{{route('ficheros.create')}}" class="btn btn-secondary">Nuevo</a>

            <div class="table-responsive">
                <table class="table">
                    <thead class="blue-grey lighten-4">
                        <tr>
                            <th>#</th>
                            <th>Descarga</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th class="text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($ficheros as $fichero)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>
                                <a href="{{route('download', $fichero->id)}}" class="download" title="Descargar">
                                    <i class="mdi mdi-download"></i>                                    
                                </a>
                            </td>
                            <td>
                                {{$fichero->nombre}}                                
                            </td>
                            <td>{{$fichero->tipo}}</td>                           
                            <td class="text-right">
                                <a class="btn btn-info" href="{{route('ficheros.show', $fichero->id)}}" title="Mostrar detalles">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                </a> 
                                <a class="btn btn-warning" href="{{route('ficheros.edit', $fichero->id)}}" title="Editar">
                                    <i class="mdi mdi-pencil"></i>
                                </a>                               
                                <form action="ficheros/{{ $fichero->id }}" method="post" class="delete">
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
            
            {{ $ficheros->links() }}
        </div>
    </div>    
@endsection