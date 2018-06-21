<?php

namespace App\Http\Controllers;

use App\DelegacionBase;
use App\Organismo;
use App\User;
use App\Cargo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDelegacionBase;
use App\Http\Requests\CargoAsign;
use Validator;

class DelegacionBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delegaciones_base = DelegacionBase::latest()->paginate(10);

        return view('backend.delegacionbase.index')->with(['delegacionesbase' => $delegaciones_base]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organismos = Organismo::all();

        return view('backend.delegacionbase.create')->with(['organismos' => $organismos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDelegacionBase $request)
    {      
        $validated = $request->validated();

        $delegacion_base = new DelegacionBase($request->all());
        $delegacion_base->save();
        
        $organismos_id = $request->organismos;
        foreach ($organismos_id as $key => $value) {
            $organismo = Organismo::find($value);
            $organismo->delegacionbase_id = $delegacion_base->id;
            $organismo->save();
        }

        flash('Delegación Base creada con éxito!')->success();

        return redirect()->route('delegacionesbase.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DelegacionBase  $delegacionBase
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $delegacion_base = DelegacionBase::find($id);
        $organismos = Organismo::where('delegacionbase_id', $delegacion_base->id)->get();
        $cargos = Cargo::where('delegacionbase_id', $delegacion_base->id)->get();
        
        return view('backend.delegacionbase.show')->with(['delegacionbase' => $delegacion_base, 'organismos' => $organismos, 'cargos' => $cargos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DelegacionBase  $delegacionBase
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $delegacion_base = DelegacionBase::find($id);
        $organismos = Organismo::all();

        return view('backend.delegacionbase.edit')->with(['delegacionbase' => $delegacion_base, 'organismos' => $organismos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DelegacionBase  $delegacionBase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'nombre.required' => 'Campo requerido.',
            'nombre.regex' => 'Solo se permiten letras.',
        ];
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|regex:/^[a-zA-Z ]+$/u'
        ], $messages)->validate();

        $delegacion_base = DelegacionBase::find($id);
        $delegacion_base->fill($request->all());
        $delegacion_base->save();

        $organismos_by_deleg = Organismo::where('delegacionbase_id', $delegacion_base->id)->get();
        foreach ($organismos_by_deleg as $key => $org) {
            $org->delegacionbase_id = null;
            $org->save();
        }

        if ($organismos_id = $request->organismos) {
            foreach ($organismos_id as $key => $value) {
                $organismo = Organismo::find($value);
                $organismo->delegacionbase_id = $delegacion_base->id;
                $organismo->save();
            }  
        }   
        flash('Delegación Base editada con éxito!')->success();     
        
        return redirect()->route('delegacionesbase.edit', ['delegacionbase' => $delegacion_base]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DelegacionBase  $delegacionBase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delegacion_base = DelegacionBase::find($id);
        $delegacion_base->delete();
        
        return redirect()->route('delegacionesbase.index');
    }

    public function cargoAsign($id) {

        $delegacion_base = DelegacionBase::find($id);
        $organismos = Organismo::where('delegacionbase_id', $delegacion_base->id)->get();
        $cargos = Cargo::where('delegacionbase_id', $delegacion_base->id)->get();

        $users = [];
        foreach ($organismos as $key => $org) {
            $users_by_org = User::where('organismo_id', $org->id)
                                ->where('presidente', false)
                                ->where('vicepresidente', false)
                                ->where('vocal', false)
                                ->where('activista', false)
                                ->where('rol', '!=', 'admin')
                                ->where('activo', true)
                                ->get();
            foreach ($users_by_org as $key1 => $user) {
                array_push($users, $user);
            }
        }

        return view('backend.delegacionbase.cargoAsign')->with(['delegacion_base' => $delegacion_base, 'users' => $users, 'cargos' => $cargos]);
    }

    public function cargoAsignAction(CargoAsign $request) {

        $validated = $request->validated();

        $delegacion_base = DelegacionBase::find($request->delegacionbase_id);
        $cargo_exist = Cargo::where('tipo', $request->tipo)->where('delegacionbase_id', $delegacion_base->id)->first();  
        $oldCargo = Cargo::where('usuario_id', $request->usuario_id)->first();

        if (!$cargo_exist) {
            if ($oldCargo) {
                $oldCargo->delete();//delete old cargo
            }
            $newCargo = new Cargo($request->all());//create cargo
            $newCargo->save();
        }
        else {           
            if ($oldCargo) {
                $oldCargo->delete();//delete old cargo
            }
            $cargo_exist->fill($request->all());//update cargo
            $cargo_exist->save();  
            
        }    

        return redirect()->route('cargoAsign', ['delegacion_base' => $delegacion_base]);
    }

}
