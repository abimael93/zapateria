<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	/**
	 * ------------------------------------------------
	 * Activando CORS
	 * ------------------------------------------------
	 */
	if($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        $statusCode = 204;

        $headers = array(
            'Access-Control-Allow-Origin'      => '*',
            'Access-Control-Allow-Methods'     => 'GET, POST, PUT , DELETE , OPTIONS',
            'Access-Control-Allow-Headers'     => 'Origin, Content-Type, Accept, Authorization, X-Requested-With',
            'Access-Control-Allow-Credentials' => 'true'
        );

        return Response::make(null, $statusCode, $headers);
    }
	/*-----------------------------------------------------------------------------------------------------------------------*/
});


App::after(function($request, $response)
{
	/**
	 * ------------------------------------------------
	 * Activando CORS
	 * ------------------------------------------------
	 */
	$response->headers->set('Access-Control-Allow-Origin', '*');
    $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT , DELETE , OPTIONS');
    $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Requested-With');
    $response->headers->set('Access-Control-Allow-Credentials', 'true');
    return $response;
	/*-----------------------------------------------------------------------------------------------------------------------*/
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


/**
*   this filter checks if a employee is already login in the system
*   @author     Ramón Lozano <gerardo528-1@hotmail.com>
*   @since      01/24/2015
*   @version    1
*   @access     public
*   @return     json ( status = ? , data = ? , mensaje = ? )
*   @example    
*/
Route::filter ( 'auth_empleado' , function () {
    if( !Auth::check() ) {
        return Response::json(
                array(
                    'status'    => NO_PERMITIDO,
                    'data'      => NULL,
                    'message'   => 'Necesitas iniciar sesion para poder ver la pagina solicitada.'
                ), 500
        );
    }
} ); 

/**
*   this filter checks if a employee has activated his account in the system changing his password
*   @author     Ramón Lozano <gerardo528-1@hotmail.com>
*   @since      01/24/2015
*   @version    1
*   @access     public
*   @return     json ( status = ? , data = ? , mensaje = ? )
*   @example    
*/
Route::filter ( 'activated_empleado' , function () {
    if( Auth::User()->estatus == 0 ) {
        return Response::json(
                array(
                    'status'    => NO_PERMITIDO,
                    'data'      => NULL,
                    'message'   => 'Necesitas establecer una nueva contraseña para poder continuar.'
                ), 500
        );
    }
} );

/**
*   this filter checks if a employee is able to go in the system
*   @author     Ramón Lozano <gerardo528-1@hotmail.com>
*   @since      01/24/2015
*   @version    1
*   @access     public
*   @return     json ( status = ? , data = ? , mensaje = ? )
*   @example    
*/
Route::filter ( 'able_empleado' , function () {
    if( Auth::User()->eliminado != 'F' ) {
        return Response::json(
                array(
                    'status'    => NO_PERMITIDO,
                    'data'      => NULL,
                    'message'   => 'Ya no puedes utilizar el sistema.'
                ), 500
        );
    }
} );

/**
*   this filters is used for maintaining the employee's session
*   @author     Ramón Lozano <gerardo528-1@hotmail.com>
*   @since      01/31/2015
*   @version    1
*   @access     public
*   @return     json ( status = ? , data = ? , mensaje = ? )
*   @example    
*/
Route::filter ( 'login_empleado' , function () {
    if( Auth::check() ) {
        $empleado = Empleado::where( 'id_empleado' , '=' , Auth::User()->id_empleado )
                            ->first(array(
                                    'id_empleado',
                                    'nombre',
                                    'apellidos',
                                    'foto',
                                    'estatus',
                                    'fecha_registro'
                                ));
        return Response::json(
                array(
                    'status'    => OK,
                    'data'      => $empleado,
                    'message'   => ''
                ), 200
        );
    }
} );