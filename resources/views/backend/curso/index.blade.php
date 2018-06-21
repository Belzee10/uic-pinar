@php($page='cursos')
@extends('backend.main')
@section('title', 'Cursos')

@section('content')

    <h4 class="titulo">Listado de Cursos</h4>

    <div class="card">
        <div class="card-body">
            <a href="{{route('cursos.create')}}" class="btn btn-secondary">Nuevo</a>

            <div class="table-responsive">
                <table class="table">
                    <thead class="blue-grey lighten-4">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Costo de matrícula</th>
                            <th>Fecha de inicio</th>
                            <th>Capacidad</th>
                            <th>Duración</th>
                            <th>Profesor</th>
                            <th class="text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($cursos as $curso)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$curso->nombre}}</td>
                            <td>{{$curso->costo_matricula}} CUP</td>
                            <td>{{$curso->fecha_inicio->formatLocalized('%A %d %B %Y')}}</td>
                            <td>{{$curso->capacidad}} Alumnos</td>
                            <td>{{$curso->duracion}} Horas</td>
                            <td>{{$curso->usuario->nombre_completo}}</td>
                            <td class="text-right">
                                <a class="btn btn-info" href="{{route('cursos.show', $curso->id)}}" title="Mostrar detalles">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                </a> 
                                <a class="btn btn-warning" href="{{route('cursos.edit', $curso->id)}}" title="Editar">
                                    <i class="mdi mdi-pencil"></i>
                                </a>                               
                                <form action="cursos/{{ $curso->id }}" method="post" class="delete">
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
            
            {{ $cursos->links() }}
        </div>
    </div>    
@endsection