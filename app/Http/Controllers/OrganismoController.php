<?php

namespace App\Http\Controllers;

use App\Organismo;
use App\DelegacionBase;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrganismo;
use Validator;

class OrganismoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organismos = Organismo::latest()->paginate(10);
        
        return view('backend.organismo.index')->with(['organismos' => $organismos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.organismo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrganismo $request)
    { 
        $validated = $request->validated();

        $organismo = new Organismo($request->all());
        $organismo->save();

        flash('Organismo creado con éxito!')->success();

        return redirect()->route('organismos.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organismo  $organismo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organismo = Organismo::find($id);
        $users = User::where('organismo_id', $id)
                        ->where('activo', true)
                        ->get();

        return view('backend.organismo.show')->with(['organismo' => $organismo, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organismo  $organismo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $organismo = Organismo::find($id);

        return view('backend.organismo.edit')->with(['organismo' => $organismo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organismo  $organismo
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

        $organismo = Organismo::find($id);
        $organismo->fill($request->all());
        $organismo->save();

        flash('Organismo editado con éxito!')->success();
        
        return redirect()->route('organismos.edit', ['organismo' => $organismo]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organismo  $organismo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organismo = Organismo::find($id);
        $organismo->delete();
        
        return redirect()->route('organismos.index');        
    }
}
