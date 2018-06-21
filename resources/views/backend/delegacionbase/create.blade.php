@php($page='delegacionesbase')
@extends('backend.main')
@section('title', 'Delegaciones Base')

@section('content')
<h4 class="titulo">Crear Delegación Base</h4>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">        
                <form method="POST" action="{{action('DelegacionBaseController@store')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="nombre" class="grey-text">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}">
                        @if ($errors->has('nombre'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="organismos" class="grey-text">Organismos</label>
                        <select multiple class="organismos form-control" id="organismos" name="organismos[]">
                            @foreach ($organismos as $org)                            
                                @if (!$org->delegacionbase_id)
                                    <option value="{{$org->id}}">{{$org->nombre}}</option>
                                @endif                            
                            @endforeach                                                
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Crear" class="btn btn-secondary" />
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