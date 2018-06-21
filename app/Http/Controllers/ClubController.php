<?php

namespace App\Http\Controllers;

use App\Club;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClub;
use Validator;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubes = Club::latest()->paginate(10);

        return view('backend.club.index')->with(['clubes' => $clubes]);
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

        return view('backend.club.create')->with(['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClub $request)
    {        
        $validated = $request->validated();

        $users = User::where('rol', '!=', 'admin')
                        ->where('activo', true)
                        ->get();
        $club = new Club($request->all());
        if ($simbolo = $request->file('simbolo')) {
            $nombre_simbolo = $simbolo->getClientOriginalName();
            $path = public_path() . '/clubes_simbolos';
            $simbolo->move($path, $nombre_simbolo);
            $club->simbolo = $path.'/'.$nombre_simbolo; 
            $club->nombre_simbolo = $nombre_simbolo;
        }   
        $club->save();
        $club->usuarios()->attach($request->usuario_id, ['lider' => false]);

        flash('Club creado con éxito!')->success();

        return redirect()->route('clubes.create')->with(['users' => $users]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $club = Club::find($id);
        
        return view('backend.club.show')->with(['club' => $club]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $club = Club::find($id);
        $users = User::where('rol', '!=', 'admin')
                        ->where('activo', true)
                        ->get();
                
        return view('backend.club.edit')->with(['club' => $club, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'nombre.required' => 'Campo requerido.',
            'nombre.regex' => 'Solo se permiten letras.',
            'simbolo.image'  => 'El símbolo debe ser una imagen (jpeg, png, bmp, gif, or svg)',
            'descripcion.required' => 'Campo requerido.'
        ];
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|regex:/^[a-zA-Z ]+$/u',
            'simbolo' => 'image',
            'descripcion' => 'required',
        ], $messages)->validate();

        $users = User::where('rol', '!=', 'admin')
                        ->where('activo', true)
                        ->get();
        $club = Club::find($id);               
        
        if ($file = $request->file('simbolo')) {
            $path_simbolo = $club->simbolo;
            $path = public_path() . '/clubes_simbolos';
            $nombre_simbolo = $file->getClientOriginalName();
            if(file_exists($path_simbolo))
            {
                unlink($path_simbolo);                
            }  
            $file->move($path, $nombre_simbolo);
            $club->simbolo = $path.'/'.$nombre_simbolo; 
            $club->nombre_simbolo = $nombre_simbolo;
        } 
        $club->nombre = $request->nombre;
        $club->descripcion = $request->descripcion;
        $club->save();

        $club->usuarios()->sync($request->usuario_id);    
        
        flash('Club editado con éxito!')->success();
       
        return redirect()->route('clubes.edit', ['club' => $club, 'users' => $users]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $club = Club::find($id);
        $club->delete();

        return redirect()->route('clubes.index');               
    }

    public function ligerAsign($club_id) 
    {
        $club = Club::find($club_id);
         
        return view('backend.club.liderAsign')->with(['club' => $club]);
    }

    public function liderAsignAction(Request $request)
    {
        $messages = [
            'miembro_id.required' => 'Campo requerido.',
        ];
        $validator = Validator::make($request->all(), [
            'miembro_id' => 'required'
        ], $messages)->validate();

        $club = Club::find($request->club_id);
        $miembro_id = $request->miembro_id;
        foreach ($club->usuarios as $key => $user) {
            if ($user->pivot->lider) {
                $club->usuarios()->updateExistingPivot($user->id, ['lider' => false]);
            }
        }
        $club->usuarios()->updateExistingPivot($miembro_id, ['lider' => true]);     
        
        flash('Líder asignado con éxito!')->success();

        return redirect()->route('liderAsign', ['club' => $club])->with(['club' => $club]);
    }

}
