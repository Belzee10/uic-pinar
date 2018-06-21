@php($page='clubes')
@extends('backend.main')
@section('title', 'Clubes')

@section('content')

    <h4 class="titulo">Listado de Clubes</h4>

    <div class="card">
        <div class="card-body">
            <a href="{{route('clubes.create')}}" class="btn btn-secondary">Nuevo</a>

            <div class="table-responsive">
                <table class="table">
                    <thead class="blue-grey lighten-4">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Líder</th>
                            <th>Símbolo</th>
                            <th class="text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($clubes as $club)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$club->nombre}}</td>
                            <td>
                                @foreach ($club->usuarios as $user)                                    
                                    @if ($user->pivot->lider)
                                        <i class="mdi mdi-account-star-variant"></i>   
                                        {{$user->nombre_completo}}
                                    @endif                                    
                                @endforeach                                
                            </td>
                            <td>
                                @if ($club->simbolo)
                                    <img src="{{asset('clubes_simbolos/'.$club->nombre_simbolo)}}" class="img-fluid" alt="Simbolo" width="30px">
                                @else
                                    <img src="{{asset('backend/img/default-club.png')}}" class="img-fluid" alt="Simbolo" width="30px">
                                @endif

                            </td>
                            <td class="text-right">
                                <a class="btn btn-primary" href="{{route('liderAsign', $club->id)}}" title="Asignar líder">
                                    <i class="mdi mdi-account-star-variant"></i>
                                </a>
                                <a class="btn btn-info" href="{{route('clubes.show', $club->id)}}" title="Mostrar detalles">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                </a> 
                                <a class="btn btn-warning" href="{{route('clubes.edit', $club->id)}}" title="Editar">
                                    <i class="mdi mdi-pencil"></i>
                                </a>                               
                                <form action="clubes/{{ $club->id }}" method="post" class="delete">
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

            {{ $clubes->links() }}            
        </div>
    </div>    
@endsection