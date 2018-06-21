<?php

namespace App\Http\Controllers;

use App\User;
use App\Ip;
use App\Organismo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UserRegister;
use App\Rules\Ci;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\Confirmation;

class UserController extends Controller
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
        $users = User::latest()->paginate(10);

        return view('backend.user.index')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $integraciones_politicas = Ip::all();
        $organismos = Organismo::all();
        $current_year = date('Y');
        $years = range(1959, $current_year);
        $years = array_reverse($years);

        return view('backend.user.create')->with(['integracionespoliticas' => $integraciones_politicas,
                                                  'organismos' => $organismos, 
                                                  'years' => $years]);
                                                  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $request->validate([
            'ci' => [new Ci],
        ]);

        $validated = $request->validated(); 

        $integraciones_politicas = Ip::all();
        $organismos = Organismo::all();
        
        $user = new User($request->all());
        $localidad_explode = explode('-', $request->provincia_municipio);
        $user->municipio = $localidad_explode[1];
        $user->provincia = $localidad_explode[0];
        $localidad_laboral_explode = explode('-', $request->provincia_municipio_laboral);
        $user->municipio_laboral = $localidad_laboral_explode[1];
        $user->provincia_laboral = $localidad_laboral_explode[0];
        $ci = $request->ci;
        $array_ci = str_split($ci);
        $year = $array_ci[0].$array_ci[1];
        $month = $array_ci[2].$array_ci[3];
        $day = $array_ci[4].$array_ci[5];
        $date = $year.'-'.$month.'-'.$day;  

        $cargo_uic = $request->cargo_uic;

        switch ($cargo_uic) {
            case 'presidente':
                $presidentes = User::where('presidente', true)->get();
                if ($presidentes->count() >= 1) {
                   flash('Ya existe 1 Presidente!')->error();
                   return redirect()->route('users.create');
                }
                $user->presidente = true;
                $user->vicepresidente = false;
                $user->vocal = false;
                $user->activista = false;
                break;
            case 'vicepresidente':
                $vicepresidentes = User::where('vicepresidente', true)->get();
                    if ($vicepresidentes->count() >= 1) {
                    flash('Ya existe 1 Vicepresidente!')->error();
                    return redirect()->route('users.create');
                    }
                $user->vicepresidente = true;
                $user->presidente = false;
                $user->vocal = false;
                $user->activista = false;
                break;
            case 'vocal':
                $vocales = User::where('vocal', true)->get();
                    if ($vocales->count() >= 1) {
                    flash('Ya existe 1 Vocal!')->error();
                    return redirect()->route('users.create');
                    }
                $user->vocal = true;
                $user->presidente = false;
                $user->vicepresidente = false;
                $user->activista = false;
                break;
            case 'activista':
                $activistas = User::where('activista', true)->get();
                        if ($activistas->count() >= 4) {
                        flash('Ya existen 4 Activistas!')->error();
                        return redirect()->route('users.create');
                        }
                $user->activista = true;
                $user->presidente = false;
                $user->vicepresidente = false;
                $user->vocal = false;
                break;
            default:
                $user->presidente = false;
                $user->vicepresidente = false;
                $user->vocal = false;
                $user->activista = false;
                break;            
        }
        

        $fecha_nac = strtotime($date); 
        $user->fecha_nacimiento = date('Y-m-d', $fecha_nac);
        $user->password = bcrypt('123');
        $user->activo = true;        
        $user->save();

        if ($request->integ_politica) {
            $user->ips()->attach($request->integ_politica);
        }

        flash('Usuario creado con éxito!')->success();
        
        return redirect()->route('users.create', 
                                        ['integracionespoliticas' => $integraciones_politicas, 
                                        'organismos' => $organismos]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('backend.user.show')->with(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $integraciones_politicas = Ip::all();
        $organismos = Organismo::all();
        $user = User::find($id);
        $current_year = date('Y');
        $years = range(1959, $current_year);
        $years = array_reverse($years);

        return view('backend.user.edit')->with(['user' => $user, 
                                                'integraciones_politicas' => $integraciones_politicas, 
                                                'organismos' => $organismos,
                                                'years' => $years]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'ci' => [new Ci],
        ]);
        $messages = [
            'required' => 'Campo requerido.',
            'correo_laboral.unique'  => 'Ya existe esa dirección de correo.',
            'regex'  => 'Solo se permiten letras.',
            'integer'  => 'Solo se permiten números.',
            'email' => 'Debe ser una dirección de correo válida.',
            'digits' => 'El teléfono debe contener 8 dígitos.'
        ];
        $validator = Validator::make($request->all(), [
            'nombre_completo' => 'required|regex:/^[a-zA-Z ]+$/u',
            'provincia_municipio' => 'required',
            'telefono_personal' => 'required|digits:8',
            'sexo' => 'required',
            'ci' => 'required',
            'direccion_particular' => 'required',
            'email' => 'required',
            'titulo_profesional' => 'required|regex:/^[a-zA-Z ]+$/u',
            'ano_graduado' => 'required',
            'universidad' => 'required|regex:/^[a-zA-Z ]+$/u',
            'centro_trabajo' => 'required|regex:/^[a-zA-Z ]+$/u',
            'provincia_municipio_laboral' => 'required',
            'correo_laboral' => 'required',
            'organismo_id' => 'required',
            'direccion_laboral' => 'required',
            'telefono_laboral' => 'required|digits:8',
            'cargo_laboral' => 'required|regex:/^[a-zA-Z ]+$/u',
            'rol' => 'required'
        ], $messages)->validate();

        $integraciones_politicas = Ip::all();
        $organismos = Organismo::all();

        $user->fill($request->all());
        $localidad_explode = explode('-', $request->provincia_municipio);
        $user->municipio = $localidad_explode[1];
        $user->provincia = $localidad_explode[0];
        $localidad_laboral_explode = explode('-', $request->provincia_municipio_laboral);
        $user->municipio_laboral = $localidad_laboral_explode[1];
        $user->provincia_laboral = $localidad_laboral_explode[0];
        $ci = $request->ci;
        $array_ci = str_split($ci);
        $year = $array_ci[0].$array_ci[1];
        $month = $array_ci[2].$array_ci[3];
        $day = $array_ci[4].$array_ci[5];
        $date = $year.'-'.$month.'-'.$day;

        $cargo_uic = $request->cargo_uic;
        switch ($cargo_uic) {
            case 'presidente':
                $presidente = User::where('presidente', true)->first();
                if ($presidente) {
                    $presidente->presidente = false;
                    $presidente->rol = 'miembro';
                    $presidente->save();
                }
                $user->presidente = true;
                $user->vicepresidente = false;
                $user->vocal = false;
                $user->activista = false;
                break;
            case 'vicepresidente':
                $vicepresidente = User::where('vicepresidente', true)->first();
                    if ($vicepresidente) {
                        $vicepresidente->vicepresidente = false;
                        $vicepresidente->rol = 'miembro';
                        $vicepresidente->save();
                    }
                $user->presidente = false;
                $user->vicepresidente = true;
                $user->vocal = false;
                $user->activista = false;
                break;
            case 'vocal':
                $vocal = User::where('vocal', true)->first();
                    if ($vocal) {
                        $vocal->vocal = false;
                        $vocal->rol = 'miembro';
                        $vocal->save();
                    }
                $user->presidente = false;
                $user->vicepresidente = false;
                $user->vocal = true;
                $user->activista = false;
                break;
            case 'activista':
                $activistas = User::where('activista', true)->get();
                if ($activistas->count() >= 4) {
                    $activista = $activistas->first();
                    $activista->activista = false;
                    $activista->rol = 'miembro';
                    $activista->save();
                }                        
                $user->presidente = false;
                $user->vicepresidente = false;
                $user->vocal = false;
                $user->activista = true;
                break; 
            default: 
                $user->presidente = false;
                $user->vicepresidente = false;
                $user->vocal = false;
                $user->activista = false;     
        } 
        $fecha_nac = strtotime($date); 
        $user->fecha_nacimiento = date('Y-m-d', $fecha_nac);

        $user->save();

        $user->ips()->sync($request->integ_politica);   
        
        flash('Usuario editado con éxito!')->success();

        return redirect()->route('users.edit', ['user' => $user, 'integraciones_politicas' => $integraciones_politicas, 'organismos' => $organismos]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        
        return redirect()->route('users.index');
    }

    public function password_change() {

        return view('auth.password_change');
    }

    public function password_change_action(Request $request) {

        $messages = [
            'required' => 'Campo requerido.',
            'min' => 'Debe tener como mínimo 8 caracteres.',
            'same' => 'Debe repetir la contraseña.'
        ];
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'repeat_password' => 'required|min:8|same:new_password'
        ], $messages)->validate();

        $user = Auth::user();

        if (Hash::check($request->old_password, Auth::user()->password))
        {
            $user->password = bcrypt($request->new_password);
            $user->save();
        }
        else {
            Flash('La contraseña antigua no coincide.')->error();
            return redirect()->route('password_change');
        }

        flash('Usted a cambiado su contraseña!')->success();
        return redirect()->route('password_change');
    }

    public function solicitudes_membresia() {

        $users = User::where('activo', false)->latest()->paginate(10);

        return view('backend.user.solicitudes_membresia')->with(['users' => $users]);
    }

    public function detalles($id) {

        $user = User::find($id);

        return view('backend.user.detalles')->with(['user' => $user]);
    }

    public function aceptar_solicitud($id) {

        $user = User::find($id);
        $array = $user->toArray();

        Mail::to($user->email)->send(new Confirmation($user));       
        
        return redirect()->route('solicitudes_membresia');
    }

    public function verify($confirmationCode) {

        $user = User::where('confirmation_code', $confirmationCode)->first();

        if ($user) {
            $user->activo = true;
            $user->confirmation_code = null;
            $user->save();
        }

        return redirect()->route('signin');
    }

    public function rechazar_solicitud($id) {

        $user = User::find($id);
        $user->delete();

        return redirect()->route('solicitudes_membresia');
    }

    public function signup() {

        $integraciones_politicas = Ip::all();
        $organismos = Organismo::all();
        $current_year = date('Y');
        $years = range(1959, $current_year);
        $years = array_reverse($years);

        return view('auth.register')->with(['integracionespoliticas' => $integraciones_politicas,
                                            'organismos' => $organismos, 
                                            'years' => $years]);
    }

    public function signup_store(UserRegister $request) {

        $request->validate([
            'ci' => [new Ci],
        ]);
        $validated = $request->validated(); 

        $user = new User($request->all());
        $localidad_explode = explode('-', $request->provincia_municipio);
        $user->municipio = $localidad_explode[1];
        $user->provincia = $localidad_explode[0];
        $localidad_laboral_explode = explode('-', $request->provincia_municipio_laboral);
        $user->municipio_laboral = $localidad_laboral_explode[1];
        $user->provincia_laboral = $localidad_laboral_explode[0];
        $ci = $request->ci;
        $array_ci = str_split($ci);
        $year = $array_ci[0].$array_ci[1];
        $month = $array_ci[2].$array_ci[3];
        $day = $array_ci[4].$array_ci[5];
        $date = $year.'-'.$month.'-'.$day;

        $fecha_nac = strtotime($date); 
        $user->fecha_nacimiento = date('Y-m-d', $fecha_nac);
        $user->rol = 'miembro';
        $user->password = bcrypt($request->password);
        $user->activo = false;
        $confirmation_code = str_random(30);
        $user->confirmation_code = $confirmation_code;
        $user->save();

        if ($request->integ_politica) {
            $user->ips()->attach($request->integ_politica);
        }

        return redirect()->route('signup_message');
    }

    public function signup_message() {

        return view('auth.signup_message');
    }

    public function signin() {

        return view('auth.login');
    }

    public function signin_store(Request $request) {

        $user = User::where('email', $request->email)->first();
        
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {   

            flash('Credenciales inválidas.')->error();

            return redirect()->route('signin');

        } elseif($user && $user->activo == false) {
            
            flash('Su cuenta no está activa.')->error();

            return redirect()->route('signin');

        } elseif(!$user) {

            flash('Credenciales inválidas.')->error();

            return redirect()->route('signin');

        } elseif(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->route('portada');

        }
    }
    
}
