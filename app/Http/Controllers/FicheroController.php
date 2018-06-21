<?php

namespace App\Http\Controllers;

use App\Fichero;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFichero;
use Validator;

class FicheroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ficheros = Fichero::latest()->paginate(10);

        return view('backend.fichero.index')->with(['ficheros' => $ficheros]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.fichero.create');
    }    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFichero $request)
    {
        $validated = $request->validated();

        $array_extensions = [//extensions allowes
            'pdf', 'docx', 'xlsx', 'pptx', 'jpg', 'png', 'jpeg', 'avi', 'mp4', 'mkv', 'mp3', 'wma', 'zip', 'rar'
        ];       

        $fichero = new Fichero;
        $file = $request->file('fichero');        
        $extension = $file->getClientOriginalExtension();        
        if (!in_array($extension, $array_extensions)) {
            flash('Solo se permiten documentos(pdf, docx, xlsx, pptx), imágenes(jpg, png, jpeg), videos(avi, mp4, mkv), audio(mp3, wma), comprimidos(zip, rar)')->error();
            return redirect()->route('ficheros.create');
        }

        $tipo = $this->tipoFichero($extension);  
        $nombre = $file->getClientOriginalName();
        $path = public_path() . '/ficheros/'.$tipo;
        $file->move($path, $nombre);

        $fichero->tipo = $tipo;
        $fichero->extension = $extension;
        $fichero->fichero = $path.'/'.$nombre;
        $fichero->nombre = $nombre;
        $fichero->save();

        flash('Fichero subido con éxito!')->success();

        return redirect()->route('ficheros.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fichero  $fichero
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fichero = Fichero::find($id);

        return view('backend.fichero.show')->with(['fichero' => $fichero]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fichero  $fichero
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fichero = Fichero::find($id);
        return view('backend.fichero.edit')->with(['fichero' => $fichero]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fichero  $fichero
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFichero $request, $id)
    {
        $validated = $request->validated();

        $array_extensions = [//extensions allowes
            'pdf', 'docx', 'xlsx', 'pptx', 'jpg', 'png', 'jpeg', 'avi', 'mp4', 'mkv', 'mp3', 'wma', 'zip', 'rar'
        ];         

        $fichero = Fichero::find($id);
        $file = $request->file('fichero');    
        if ($file) {
            $extension = $file->getClientOriginalExtension();
            if (!in_array($extension, $array_extensions)) {
                flash('Solo se permiten documentos(pdf, docx, xlsx, pptx), imágenes(jpg, png, jpeg), videos(avi, mp4, mkv), audio(mp3, wma), comprimidos(zip, rar)')->error();
                return redirect()->route('ficheros.create');
            }
            $tipo = $this->tipoFichero($extension);  
            $nombre = $file->getClientOriginalName();
            $path = public_path() . '/ficheros/'.$tipo;
            $path_fichero = $fichero->fichero;
            if(file_exists($path_fichero))
            {
                unlink($path_fichero);                
            }  
            $file->move($path, $nombre);
            $fichero->tipo = $tipo;
            $fichero->extension = $extension;
            $fichero->fichero = $path.'/'.$nombre;
            $fichero->nombre = $nombre;
        }
        $fichero->save();

        flash('Fichero editado con éxito!')->success();
        
        return redirect()->route('ficheros.edit', ['fichero' => $fichero]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fichero  $fichero
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fichero = Fichero::find($id);
        $path = $fichero->fichero;
        if(file_exists($path))
        {
            unlink($path);
            $fichero->delete();
        }        

        return redirect()->route('ficheros.index'); 
    }

    public function download($id) 
    {
        $fichero = Fichero::find($id);

        return response()->download($fichero->fichero);
    }

    public function tipoFichero($extension) {
       if ($extension == 'pdf' || $extension == 'docx' || $extension == 'xlsx' || $extension == 'pptx') {
           return $tipo = 'documento';
       }
       elseif ($extension == 'jpg' || $extension == 'png' || $extension == 'jpeg') {
           return $tipo = 'imagen';
       }
       elseif ($extension == 'avi' || $extension == 'mp4' || $extension == 'mkv') {
           return $tipo = 'video';
       }
       elseif ($extension == 'mp3' || $extension == 'wma') {
           return $tipo = 'audio';
       }
       elseif ($extension == 'zip' || $extension == 'rar') {
           return $tipo = 'comprimido';
       }
       return;
    }    
}
