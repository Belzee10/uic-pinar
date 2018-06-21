@php($page='delegacionesbase')
@extends('backend.main')
@section('title', 'Delegaciones Base')

@section('content')
<h4 class="titulo">Editar Delegación Base</h4>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{action('DelegacionBaseController@update', $delegacionbase->id)}}">
                    {{csrf_field()}}
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <label for="nombre" class="grey-text">Nombre</label>
                        <input type="text" id="nombre" name="nombre" value="{{$delegacionbase->nombre}}" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}">
                        @if ($errors->has('nombre'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="organismos" class="grey-text">Organismos</label>
                        <select multiple class="organismos form-control" id="organismos" name="organismos[]">
                            @foreach ($organismos as $key => $org)                            
                                <option value="{{$org->id}}"                                             
                                        @if($org->delegacionbase_id == $delegacionbase->id) selected="selected" @endif
                                >{{$org->nombre}}</option>
                            @endforeach                                               
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Editar" class="btn btn-secondary" />
                        <a href="{{route('delegacionesbase.index')}}" class="btn btn-blue-grey">Volver al Listado</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        @include('flash::message')
    </div>
</div>

@endsection

@section('js')
    <script>
        $('.organismos').chosen({
            placeholder_text_multiple: " ",
            no_results_text: "No se encontraron resultados"
        });
    </script>
@endsection