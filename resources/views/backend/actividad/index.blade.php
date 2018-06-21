@php($page='actividades')
@extends('backend.main')
@section('title', 'Actividades')

@section('content')

    <h4 class="titulo">Listado de Actividades</h4>

    <div class="card">
        <div class="card-body">
            <a href="{{route('actividades.create')}}" class="btn btn-secondary">Nuevo</a>

            <div class="table-responsive">
                <table class="table">
                    <thead class="blue-grey lighten-4">
                        <tr>
                            <th>#</th>
                            <th>Tipo</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Responsable</th>
                            <th class="text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($actividades as $act)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$act->tipo}}</td>
                            <td>{{$act->fecha->formatLocalized('%A %d %B %Y')}}</td>
                            <td>                                
                                @if ($act->estado)
                                    Cumplida
                                @else
                                    no cumplida
                                @endif
                            <td>{{$act->usuario->nombre_completo}}</td>
                            <td class="text-right">
                                <a class="btn btn-info" href="{{route('actividades.show', $act->id)}}" title="Mostrar detalles">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                </a> 
                                <a class="btn btn-warning" href="{{route('actividades.edit', $act->id)}}" title="Editar">
                                    <i class="mdi mdi-pencil"></i>
                                </a>                               
                                <form action="actividades/{{ $act->id }}" method="post" class="delete">
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
            
            {{ $actividades->links() }}
        </div>
    </div>    
@endsection