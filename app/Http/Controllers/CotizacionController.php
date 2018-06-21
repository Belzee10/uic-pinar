<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Cotizacion;

class CotizacionController extends Controller
{

    public function __construct() {

        setlocale(LC_TIME, 'Spanish');
        Carbon::setUtf8(true); 
          
    }

    public function listado(Request $request) { 

        $now = Carbon::now();
        $current_year = $now->format('Y');
        $current_month = $now->format('m');

        $array = range(2018, $current_year);

        $years = array_reverse($array);
        $months = ['01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'];
        
        $users = User::where('rol', '!=', 'admin')
                        ->where('activo', true)
                        ->latest()->paginate(10);

        foreach ($users as $key => $user) {
            $array_cotizacion = [];
            if ($request->month && $request->year) {
                $cotizacion = Cotizacion::where('usuario_id', $user->id)
                            ->where('mes', $request->month)
                            ->where('ano', $request->year)
                            ->first();
                $current_month = $request->month;
                $current_year = $request->year;
            } else {
                $cotizacion = Cotizacion::where('usuario_id', $user->id)
                            ->where('mes', $current_month)
                            ->where('ano', $current_year)
                            ->first();
            }                

            $id = $cotizacion ? $cotizacion->id : '';
            $importe = $cotizacion ? $cotizacion->importe : '';
            $mes = $cotizacion ? $cotizacion->mes : '';
            $ano = $cotizacion ? $cotizacion->ano : '';

            $array_cotizacion = [
                'id' => $id,
                'importe' => $importe,
                'mes' => $mes,
                'ano' => $ano
            ];
            array_add($user, 'cotizacion', $array_cotizacion);
            // dd($users);
        }

        return view('backend.cotizaciones.listado')->with(['users' => $users,
                                                           'years' => $years,
                                                           'months' => $months,
                                                           'current_year' => $current_year,
                                                           'current_month' => $current_month
                                                           ]);
    }

    public function cotizar(Request $request) {

        $editable = $request->editable;
        $cotizacion_id = $request->cotizacion_id;

        if ($editable == '0' && $request->importe > 0) {

            $cotizacion = new Cotizacion();
            $cotizacion->importe = $request->importe;
            $cotizacion->mes = $request->mes;
            $cotizacion->ano = $request->ano;
            $cotizacion->usuario_id = $request->usuario_id;
            $cotizacion->save(); 

        } elseif ($editable == '1') {
            $cotizacion = Cotizacion::find($cotizacion_id);
            if ($request->importe > 0) {
                $cotizacion->importe = $request->importe;
                $cotizacion->mes = $request->mes;
                $cotizacion->ano = $request->ano;
                $cotizacion->usuario_id = $request->usuario_id;
                $cotizacion->save();
            } else {
                $cotizacion->delete();
            } 
        }        

        return redirect()->route('cotizaciones');
    }    

}
