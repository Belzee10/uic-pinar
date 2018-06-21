<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//FRONTEND
Route::get('/', 'FrontendController@portada')->name('portada');
Route::get('repositorio', 'FrontendController@repositorio')->name('repositorio');
Route::get('repositorio/download/{id}', 'FrontendController@download')->name('repositorioDownload');//force to download file from frontend 
Route::get('clubes', 'FrontendController@clubes')->name('clubes');  
Route::get('cursos', 'FrontendController@cursos')->name('cursos');  
Route::get('cursos/{id}', 'FrontendController@detalle_curso')->name('detalle_curso');
Route::get('cursos/apuntarse/{id}', 'FrontendController@curso_apuntarse')->name('curso_apuntarse');  
Route::get('cursos/des_apuntarse/{id}', 'FrontendController@curso_des_apuntarse')->name('curso_des_apuntarse'); 
Route::get('cursos-create/{id}', 'FrontendController@cursoCreate')->name('cursoCreate');
Route::post('participantes-store', 'FrontendController@participantesStore')->name('participantesStore');

Route::get('actividades', 'FrontendController@actividades')->name('actividades');  
Route::get('download-estatutos', 'FrontendController@download_estatutos')->name('download_estatutos');
Route::get('download-codigo-etica', 'FrontendController@download_codigo_etica')->name('download_codigo_etica');
Route::get('mision', function() {
    return view('frontend.mision');
})->name('mision');

Route::get('signup', 'UserController@signup')->name('signup');
Route::post('signup-store', 'UserController@signup_store')->name('signup_store');
Route::get('signup-message', 'UserController@signup_message')->name('signup_message');
Route::get('signin', 'UserController@signin')->name('signin');
Route::post('signin-store', 'UserController@signin_store')->name('signin_store');

//END FRONTEND

//BACKEND
Route::prefix('admin')->middleware('auth')->group(function() {

    Route::get('/', function() {
        return view('backend.welcome');
    })->name('welcome');

    Route::prefix('reportes')->group(function() {
        Route::get('listado_miembros', 'ReporteController@listado_miembros')->name('listado_miembros');
        Route::get('listado_miembros_excel', 'ReporteController@listado_miembros_excel')->name('listado_miembros_excel');
        Route::get('planilla_solicitud', 'ReporteController@planilla_solicitud')->name('planilla_solicitud');
        Route::get('planilla_solicitud_word/{id}', 'ReporteController@planilla_solicitud_word')->name('planilla_solicitud_word');
        Route::get('listado_cotizaciones', 'ReporteController@listado_cotizaciones')->name('listado_cotizaciones');
        Route::post('listado_cotizaciones_excel', 'ReporteController@listado_cotizaciones_excel')->name('listado_cotizaciones_excel');       
    });

    Route::get('cambiar-password', 'UserController@password_change')->name('password_change');
    Route::post('cambiar-password-action', 'UserController@password_change_action')->name('password_change_action');

    Route::middleware('rol')->group(function() {       
    
        Route::get('ficheros/download/{id}', 'FicheroController@download')->name('download');//force to download file    
        Route::get('clubes/asignar-lider/{id}', 'ClubController@ligerAsign')->name('liderAsign');//view lider asign
        Route::post('clubes/asignar-lider', 'ClubController@liderAsignAction');//lider asign action
        Route::get('delegacionesbase/asignar-cargos/{id}', 'DelegacionBaseController@cargoAsign')->name('cargoAsign');//view cargo asign
        Route::post('delegacionesbase/asignar-cargos', 'DelegacionBaseController@cargoAsignAction');//cargo asign action
        Route::get('solicitudes-membresia', 'UserController@solicitudes_membresia')->name('solicitudes_membresia');
        Route::get('solicitudes-membresia/detalles/{id}', 'UserController@detalles')->name('detalles');
        Route::get('solicitudes-membresia/aceptar-solicitud/{id}', 'UserController@aceptar_solicitud')->name('aceptar_solicitud');
        Route::get('solicitudes-membresia/rechazar-solicitud/{id}', 'UserController@rechazar_solicitud')->name('rechazar_solicitud');
        Route::get('register/verify/{confirmationCode}', 'UserController@verify')->name('verify');
    
        Route::resource('delegacionesbase', 'DelegacionBaseController');
        Route::resource('organismos', 'OrganismoController');    
        Route::resource('ficheros', 'FicheroController');
        Route::resource('users', 'UserController');    
        Route::resource('clubes', 'ClubController');
        Route::resource('actividades', 'ActividadController');
        Route::resource('cursos', 'CursoController');  
        Route::get('cotizaciones', 'CotizacionController@listado')->name('cotizaciones');  
        Route::post('cotizar', 'CotizacionController@cotizar')->name('cotizar');
    });        
});

//END BACKEND

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
