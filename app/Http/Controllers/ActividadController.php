<?php

namespace App\Http\Controllers;

use App\Actividad;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\StoreActividad;
use Validator;

class ActividadController extends Controller
{

    public function __construct() {

        setlocale(LC_TIME, 'Spanish');
        Carbon::setUtf8(true); 
          
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        
        $actividades = Actividad::latest()->paginate(10);
        
        return view('backend.actividad.index')->with(['actividades' => $actividades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('rol', '!=', 'admin')
                     ->where('activo', true)
                     ->get(); 

        return view('backend.actividad.create')->with(['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActividad $request)
    {
        $validated = $request->validated();

        $actividad = new Actividad($request->all());
        $actividad->save();

        flash('Actividad creada con éxito!')->success();

        return redirect()->route('actividades.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actividad = Actividad::find($id);

        return view('backend.actividad.show')->with(['actividad' => $actividad]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $actividad = Actividad::find($id);
        $users = User::where('rol', '!=', 'admin')
                     ->where('activo', true)
                     ->get();    

        return view('backend.actividad.edit')->with(['actividad' => $actividad, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => 'Campo requerido.',
            'fecha.date_format' => 'Formato inválido',
        ];
        $validator = Validator::make($request->all(), [
            'tipo' => 'required',
            'fecha' => 'required|date_format:Y-m-d',
            'estado' => 'required',
            'usuario_id' => 'required',
        ], $messages)->validate();

        $actividad = Actividad::find($id);
        $actividad->fill($request->all());
        $actividad->save();

        flash('Actividad editada con éxito!')->success();
        
        return redirect()->route('actividades.edit', ['actividad' => $actividad]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actividad = Actividad::find($id);
        $actividad->delete();
        
        return redirect()->route('actividades.index');  
    }
}
