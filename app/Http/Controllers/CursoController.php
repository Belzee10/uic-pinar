<?php

namespace App\Http\Controllers;

use App\Curso;
use App\User;
use App\Participante;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\StoreCurso;
use Validator;

class CursoController extends Controller
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
        $cursos = Curso::latest()->paginate(10);
        
        return view('backend.curso.index')->with(['cursos' => $cursos]);
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

        return view('backend.curso.create')->with(['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCurso $request)
    {
        $validated = $request->validated();

        $curso = new Curso($request->all());
        $curso->save();

        flash('Curso creado con éxito!')->success();

        return redirect()->route('cursos.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso = Curso::find($id);
        $participantes = Participante::where('curso_id', $id)->get();

        return view('backend.curso.show')->with(['curso' => $curso, 'participantes' => $participantes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $curso = Curso::find($id);
        $users = User::where('rol', '!=', 'admin')
                        ->where('activo', true)
                        ->get();    

        return view('backend.curso.edit')->with(['curso' => $curso, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => 'Campo requerido.',
            'nombre.regex'  => 'Solo se permiten letras y números',
            'costo_matricula.integer'  => 'Solo se permiten números',
            'costo_matricula.between'  => 'El rango del costo de la matrícula es de 1 - 999',
            'lugar.regex'  => 'Solo se permiten letras y números',
            'fecha_inicio' => 'Formato inválido',
            'capacidad.integer'  => 'Solo se permiten números',
            'capacidad.between'  => 'El rango de la capacidad es de 1 - 999',
            'duracion.integer'  => 'Solo se permiten números',
            'duracion.between'  => 'El rango de la duración es de 1 - 999',
        ];
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|regex:/^[a-zA-Z0-9 ]+$/u',
            'costo_matricula' => 'required|integer|between:1,999',
            'lugar' => 'required|regex:/^[a-zA-Z0-9 ]+$/u',
            'fecha_inicio' => 'required|date_format:Y-m-d',
            'capacidad' => 'required|integer|between:1,999',
            'duracion' => 'required|integer|between:1,999',
            'usuario_id' => 'required',
        ], $messages)->validate();

        $curso = Curso::find($id);
        $curso->fill($request->all());
        $curso->save();

        flash('Curso editado con éxito!')->success();
        
        return redirect()->route('cursos.edit', ['curso' => $curso]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso = Curso::find($id);
        $curso->delete();
        
        return redirect()->route('cursos.index'); 
    }
}
