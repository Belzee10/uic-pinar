@php($page='cotizaciones')
@extends('backend.main')
@section('title', 'Cotizaciones')

@section('content')
@php ($array = ['01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'])
    <h4 class="titulo">Listado de miembros a cotizar de <em class="lead" style="font-size: 1.5rem; font-weight: 400">{{$array[$current_month]}} del {{$current_year}}</em></h4>

    <div class="card">
        <div class="card-body">
            <form method="GET" class="form-inline mb-3" action="{{action('CotizacionController@listado')}}">                
                {{csrf_field()}}
                <div class="form-group mr-1">
                    <select name="month" id="month" class="form-control-sm">
                        @foreach ($months as $key => $value)
                            <option @if($key == $current_month) selected @endif value="{{$key}}">{{$value}}</option>
                        @endforeach                        
                    </select>
                </div>
                <div class="form-group">
                    <select name="year" id="year" class="form-control-sm">
                        @foreach ($years as $value)
                            <option @if($value == $current_year) selected @endif value="{{$value}}">{{$value}}</option>
                        @endforeach                        
                    </select>
                </div>
                <div class="form-group ml-3">
                    <input type="submit" value="Buscar" class="btn btn-sm btn-secondary px-3" />
                </div>
            </form>            

            <div class="table-responsive">
                <table class="table">
                    <thead class="blue-grey lighten-4">
                        <tr>
                            <th>#</th>
                            <th>Nombre y apellidos</th>
                            <th>Ci</th>
                            <th>Provincia</th>
                            <th>Municipio</th>
                            <th>Importe</th>
                            <th class="text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$user->nombre_completo}}</td>
                            <td>                                
                                {{$user->ci}}
                            </td>
                            <td>{{$user->provincia}}</td>
                            <td>{{$user->municipio}}</td>
                            <td>
                                @if ($user->cotizacion['importe'])
                                    ${{$user->cotizacion['importe']}}
                                @endif
                            </td>
                            <td class="text-right">                                    
                                @if ($user->cotizacion['importe'])
                                    <a class="btn btn-planilla btn-warning px-2" 
                                            data-toggle="modal" data-target="#myModal" 
                                            data-user-id="{{$user->id}}" data-editable="1"
                                            data-importe="{{$user->cotizacion['importe']}}"
                                            data-cotizacion-id="{{$user->cotizacion['id']}}"
                                            title="Cotizar">
                                        Editar
                                    </a>
                                @else
                                    <a class="btn btn-planilla btn-primary px-2" 
                                            data-toggle="modal" data-target="#myModal" 
                                            data-user-id="{{$user->id}}" data-editable="0"
                                            title="Cotizar">
                                        Cotizar
                                    </a> 
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
    
    <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="example" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cotizar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="cotizar_form" method="POST" action="{{action('CotizacionController@cotizar')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="importe">Importe</label>                                            
                            <input type="number" min="0" class="form-control" name="importe" id="importe" placeholder="0.00" required step="0.01" pattern="^\d+(?:\.\d{1,2})?$"
                            onblur="this.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'">                            
                        </div>
                        <input id="usuario_id" name="usuario_id" type="number" hidden>
                        <input id="mes" name="mes" type="text" hidden>
                        <input id="ano" name="ano" type="text" hidden>
                        <input id="editable" name="editable" type="text" hidden>
                        <input id="cotizacion_id" name="cotizacion_id" type="text" hidden>

                        <div class="form-group">
                            <input type="submit" value="Guardar" class="btn btn-secondary enviar" />
                            <button type="button" class="btn btn-blue-grey" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>                                    
                </div>                                    
                </div>
            </div>
        </div> 
@endsection

@section('js')
    <script type="text/javascript">

        $(function() {
            $('#myModal').on("show.bs.modal", function (e) {
                var editable = $(e.relatedTarget).data('editable');
                var userId = $(e.relatedTarget).data('user-id');
                var importe = $(e.relatedTarget).data('importe');
                var cotizacionId = $(e.relatedTarget).data('cotizacion-id');

                $("#usuario_id").val(userId);
                $("#mes").val($('#month').val());
                $("#ano").val($('#year').val());

                if (editable == 1) {
                    $('#cotizacion_id').val(cotizacionId);
                    $('#editable').val('1');
                    $('#importe').val(importe);
                }
                else {
                    $('#editable').val('0');                    
                }                
            });
        });

    </script>
@endsection