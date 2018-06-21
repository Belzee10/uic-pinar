@php($page='clubes')
@extends('backend.main')
@section('title', 'Clubes')

@section('content')
<h4 class="titulo">Crear Club</h4>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">        
                <form method="POST" action="{{action('ClubController@store')}}" enctype="multipart/form-data">
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
                        <label for="simbolo" class="grey-text">Símbolo (opcional)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input{{ $errors->has('simbolo') ? ' is-invalid' : '' }}" id="simbolo" name="simbolo" lang="es">
                            <label class="custom-file-label" for="simbolo">Seleccionar símbolo...</label>
                            @if ($errors->has('simbolo'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('simbolo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="usuario_id" class="grey-text">Integrantes</label>
                        <select multiple class="form-control integrantes" id="usuario_id" name="usuario_id[]">
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->nombre_completo}}</option>
                            @endforeach                                                
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="descripcion" class="grey-text">Descripción</label>
                        <textarea class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" id="descripcion" name="descripcion" rows="3"></textarea>
                        @if ($errors->has('descripcion'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('descripcion') }}</strong>
                            </span>
                        @endif
                    </div>                    

                    <div class="form-group">
                        <input type="submit" value="Crear" class="btn btn-secondary" />
                        <a href="{{route('clubes.index')}}" class="btn btn-blue-grey">Volver al Listado</a>
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
        $('.integrantes').chosen({
            placeholder_text_multiple: " ",
            no_results_text: "No se encontraron resultados"
        });
    </script>
@endsection
