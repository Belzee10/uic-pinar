@php($page='users')
@extends('backend.main')
@section('title', 'Usuarios')

@section('content')

    <h4 class="titulo">Listado de Usuarios</h4>

    <div class="card">
        <div class="card-body">
            <a href="{{route('users.create')}}" class="btn btn-secondary">Nuevo</a>

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
                            <th>Rol</th>
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
                            <td>
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
                            </td>
                            <td class="text-right">
                                <a class="btn btn-info" href="{{route('users.show', $user->id)}}" title="Mostrar detalles">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                </a>
                                <a class="btn btn-warning" href="{{route('users.edit', $user->id)}}" title="Editar">
                                    <i class="mdi mdi-pencil"></i>
                                </a>
                                @if ($user->rol != 'admin')
                                    <form action="users/{{ $user->id }}" method="post" class="delete">
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-danger" title="Eliminar">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                @endif 
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