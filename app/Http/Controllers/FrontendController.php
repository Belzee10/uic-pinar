<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Fichero;
use App\Club;
use App\Curso;
use App\Actividad;
use App\User;
use App\Participante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CursoInscripcion;
use App\Rules\Ci;
use Validator;

class FrontendController extends Controller
{

    public function __construct() {

        setlocale(LC_TIME, 'Spanish');
        Carbon::setUtf8(true); 
        
    }
    
    public function portada() {
        //miembros count
        $users = User::where('rol', '!=', 'admin')
                        ->where('activo', true)
                        ->get();
        $users_count = $users->count();
        
        //clubes count
        $clubes = Club::all();
        $clubes_count = $clubes->count();

        //cursos count
        $cursos = Curso::all();
        $now = Carbon::now();
        $current_date = $now->format('Y-m-d');
        $array_cursos = [];
        foreach ($cursos as $key => $curso) {
            $curso_date = Carbon::parse($curso->fecha_inicio);
            if ($curso_date >= $current_date) {
                array_push($array_cursos, $curso);
            }
        }
        $cursos_count = count($array_cursos);

        //ficheros count
        $ficheros = Fichero::all();
        $ficheros_count = $ficheros->count();

        return view('frontend.portada')->with(['users_count' => $users_count,
                                              'clubes_count' => $clubes_count,
                                              'cursos_count' => $cursos_count,
                                              'ficheros_count' => $ficheros_count]);
    }

    public function download_estatutos() {

        return response()->download('C:\xampp\htdocs\uic\public/frontend/docs/E S T A T U T O S  cambios en AN.docx');
    }

    public function download_codigo_etica() {

        return response()->download('C:\xampp\htdocs\uic\public/frontend/docs/CodigodeEtica.pdf');
    }

    public function clubes() {

        $clubes = Club::all();

        return view('frontend.clubes')->with(['clubes' => $clubes]);
    }

    public function cursos() {

        $cursos = Curso::all();

        $now = Carbon::now();
        $current_date = $now->format('Y-m-d');

        $array_cursos = [];
        foreach ($cursos as $key => $curso) {
            $curso_date = Carbon::parse($curso->fecha_inicio);
            if ($curso_date >= $current_date) {
                array_push($array_cursos, $curso);
            }
        }

        if (Auth::check()) {
            foreach ($array_cursos as $key => $curso) {
                $participante = Participante::where('curso_id', $curso->id)->where('correo', Auth::user()->email)->first();
                if ($participante) {
                    array_add($curso, 'participante', $participante);
                }
            }
        }
        

        return view('frontend.cursos')->with(['cursos' => $array_cursos]);
    }

    public function curso_apuntarse($id) {

        $curso = Curso::find($id);

        if (Auth::check()) {
            $user_id = Auth::id();
            $user = User::find($user_id);
            $participante = new Participante();
            $participante->nombre_completo = $user->nombre_completo;
            $participante->ci = $user->ci;
            $participante->correo = $user->email;
            $participante->telefono = $user->telefono_personal;
            $participante->curso_id = $curso->id;
            $participante->save();
            
            return redirect()->route('cursos');
        } else {

            return redirect()->route('cursoCreate', ['id' => $id]);
        }       
    }

    public function curso_des_apuntarse($id) {

        $curso = Curso::find($id);

        if (Auth::check()) {
            $participante = Participante::where('curso_id', $id)->where('correo', Auth::user()->email)->first();
            $participante->delete();
            
            return redirect()->route('cursos');
        } 
    }

    public function cursoCreate($id) {

        return view('frontend.apuntarse_curso')->with(['curso_id' => $id]);
    }

    public function participantesStore(CursoInscripcion $request) {

        $request->validate([
            'ci' => [new Ci],
        ]);

        $validated = $request->validated(); 

        $participante = new Participante($request->all());
        $participante->save();

        return redirect()->route('cursos');
    }

    public function detalle_curso($id) {

        $curso = Curso::find($id);

        return view('frontend.detalle_curso')->with(['curso' => $curso]);
    }

    public function actividades() {

        $actividades = Actividad::orderBy('fecha', 'desc')->get();                                    

        return view('frontend.actividades')->with(['actividades' => $actividades]);
    }

    public function repositorio() {

        $documentos = [];
        $imagenes = [];
        $videos = [];
        $audios = [];
        $comprimidos = [];
        $ficheros = Fichero::all();

        foreach ($ficheros as $key => $fichero) {
            if ($fichero->tipo == 'documento') {
                array_push($documentos, $fichero);
            }
            elseif ($fichero->tipo == 'imagen') {
                array_push($imagenes, $fichero);
            }
            elseif ($fichero->tipo == 'video') {
                array_push($videos, $fichero);
            }
            elseif ($fichero->tipo == 'audio') {
                array_push($audios, $fichero);
            }
            elseif ($fichero->tipo == 'comprimido') {
                array_push($comprimidos, $fichero);
            }
        }

        return view('frontend.repositorio')->with(['documentos' => $documentos, 
                                                   'imagenes' => $imagenes,
                                                   'videos' => $videos,
                                                   'audios' => $audios,
                                                   'comprimidos' => $comprimidos]);                                                    

    }

    public function download($id) {
        
        $fichero = Fichero::find($id);

        return response()->download($fichero->fichero);
    }


}
