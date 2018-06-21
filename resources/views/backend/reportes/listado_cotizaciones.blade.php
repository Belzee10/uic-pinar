@php($page='listado_cotizaciones')
@extends('backend.main')
@section('title', 'Reportes - Listado de cotizaciones')

@section('content')

    <h4 class="titulo">Exportar listado de cotizaciones</h4>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body"> 
                    <form method="POST" class="form-inline mb-3" action="{{action('ReporteController@listado_cotizaciones_excel')}}">                
                        {{csrf_field()}}
                        <div class="form-group mr-1">
                            <select name="month" id="month" class="form-control-sm">
                                @foreach ($months as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach                        
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="year" id="year" class="form-control-sm">
                                @foreach ($years as $value)
                                    <option value="{{$value}}">{{$value}}</option>
                                @endforeach                        
                            </select>
                        </div>
                        <div class="form-group ml-3">
                            <input type="submit" value="Exportar a excel" class="btn btn-sm btn-excel px-3"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
                
@endsection