<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

define('OK',                                0);
define('ERROR_DB',                          1);
define('DATOS_INCOMPLETOS',                 2);
define('LOGIN_FALLIDO',                     3);
define('SERVICIO_INEXISTENTE',              4);
define('FORMATO_INCORRECTO',                5);
define('ID_INCORRECTO',                     6);
define('CONTENIDO_DUPLICADO',               7);
define('HEADERS_INVALIDOS',                 8);
define('ERROR_SERVIDOR',                    9);
define('AUTENTICACION',                     10);
define('API_FALLIDA',                       11);
define('VACIO',                             12);
define('VALIDACION_ERROR',                  13);
define('NO_PERMITIDO',                      14);
define('ERROR_LIMITE_ARCHIVO',              15);
define('ERROR_LIMITE_POST',                 16);
define('SESION_INICIADA',	                17);
define('ARCHIVO_INVALIDO',	                18);
define('INVITACION_ENVIADA_ANTERIORMENTE',  19);
define('USUARIO_LOGUEADO',                  20);

define('SERVIDOR',__DIR__);

require(SERVIDOR.'/helpers/Utiles.php');

Route::get( '/' , function()
{
	return View::make('hello');
});

Route::post( '/login' , array( 'uses' => 'EmpleadoController@acceder' ) );
Route::post( '/logout' , array( 'uses' => 'EmpleadoController@salir' ) );

Route::group( array( 'prefix' => 'empleados' ) , function () {
    Route::get( '/{id_empleado}' , array( 'uses' => 'EmpleadoController@mostrar' ) );
    Route::post( '' , array( 'uses' => 'EmpleadoController@registrar' ) );
    Route::put( '' , array( 'uses' => 'EmpleadoController@modificar' ) );
    Route::put( '/{id_empleado}' , array( 'uses' => 'EmpleadoController@modificar' ) );
    Route::put( '/changePassword' , array( 'uses' => 'EmpleadoController@cambiar_password' ) );
});

Route::group( array( 'prefix' => 'catalogos' ) , function () {
    Route::get( '/{tipo}' , array( 'uses' => 'CatalogoController@catalogos' ) );
});
