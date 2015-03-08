<?php

class EmpleadoController extends BaseController{
    private $validaciones;
    private $validaciones_login;
    private $campos;
    private $campos_root;
    function __construct () {
        
        $this->validaciones = array(
                                'id_cargo'          => array( 'required' , 'integer' ),
                                'id_departamento'   => array( 'required' , 'integer' ),
                                'id_pais'           => array( 'required' , 'integer' ),
                                'id_estado'         => array( 'required' , 'integer' ),
                                'id_municipio'      => array( 'required' , 'integer' ),
                                'id_colonia'        => array( 'required' , 'integer' ),
                                'nombre'            => array( 'required' , 'alpha_spaces' ),
                                'apellidos'         => array( 'required' , 'alpha_spaces' ),
                                'rfc'               => array( 'sometimes' , 'alpha_num' ),
                                'foto'              => array( 'sometimes' ),
                                'correo'            => array( 'sometimes' , 'email' ),
                                'usuario'           => array( 'sometimes' , 'alpha_dash' ),
                                'password'          => array( 'sometimes' ),
                                'eliminado'         => array( 'sometimes' ),
                                'calle'             => array( 'required' , 'allow_all' ),
                                'num_int'           => array( 'sometimes' , 'allow_all' ),
                                'num_ext'           => array( 'required' , 'allow_all' ),
                                'telefono'          => array( 'required' , 'numeric' ),
                                'celular'           => array( 'sometimes' , 'numeric' ),
                                'estatus'           => array( 'sometimes' , 'boolean' ),
                            );
        $this->validaciones_login = array(
                                        'usuario'           => array( 'required' , 'alpha_dash' ),
                                        'password'          => array( 'required' ),
                                    );
        $this->campos   = array(
                                '*',
                                DB::raw('(SELECT nombre FROM cargo WHERE empleado.id_cargo = 
                                    cargo.id_cargo) AS cargo'),
                                DB::raw('(SELECT nombre FROM pais WHERE empleado.id_pais = pais.id_pais) AS pais'),
                                DB::raw('(SELECT nombre FROM estado WHERE empleado.id_estado = 
                                    estado.id_estado) AS estado'),
                                DB::raw('(SELECT abrev FROM estado WHERE empleado.id_estado = 
                                    estado.id_estado) AS estado_abrev'),
                                DB::raw('(SELECT nombre FROM municipio WHERE empleado.id_municipio = 
                                    municipio.id_municipio) AS municipio'),
                                DB::raw('(SELECT nombre FROM colonia WHERE empleado.id_colonia = 
                                    colonia.id_colonia) AS colonia'),
                          );
        $this->campos_root = array(
                                    'id_empleado',
                                    DB::raw('(SELECT nombre FROM cargo WHERE empleado.id_cargo = 
                                    cargo.id_cargo) AS cargo'),
                                    'nombre',
                                    'apellidos',
                                    'foto',
                                    'estatus',
                                    'fecha_registro'
                                  );
    }

    /**
    *   this function registers an employee to the system
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      01/18/2015
    *   @version    1
    *   @access     public
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/empleados by post
    */
    public function registrar () {
        Input::merge( 
                        array( 
                            'nombre'     => ucwords( strtolower( Input::get( 'nombre' ) ) ) , 
                            'apellidos'  => ucwords( strtolower( Input::get( 'apellidos' ) ) ),
                            'password'   => Hash::make( '1234' ),
                        ) 
                    );
        $inputs    = Input::all();
        $validador = Validator::make( $inputs , $this->validaciones );
        if ( !$validador->fails() ) {
            try {
                DB::transaction( function() use ( $inputs ) {
                    $empleado = new Empleado();
                    if ( array_key_exists( 'foto' , $inputs ) ) {
                        $imagen = new SimpleImage( $inputs['foto'] );
                        $imagen->resize( 110 , 110 );
                        $imagen->save( $inputs['foto'] );
                        $ruta_salida = explode( '.' , $inputs['foto'] )[0];
                        $extension   = explode( '.' , $inputs['foto'] )[1];
                        CircleCrop::circleCropImage($inputs['foto'],$ruta_salida.'.png');
                        if($extension != 'png'){
                            unlink($inputs['foto']);
                            $inputs['foto'] = $ruta_salida.'.png';
                        }
                    }
                    $empleado->create( $inputs );
                } );
                $status   = OK;
                $data     = NULL;
                $mensaje  = 'Empleado registrado.';
            } catch ( Exception $e ) {
                $status  = ERROR_DB;
                $data    = NULL;
                $mensaje = 'Error al insertar empleado.';
            }
        } else {
            $mensajes = $validador->messages();
            foreach ( $mensajes->all() as $mensaje ){
                if( substr( $mensaje , 0 , 8 ) == 'required' ){
                    $status  = DATOS_INCOMPLETOS;
                    $mensaje = substr( $mensaje , 9 );
                }
                else{
                    $status  = FORMATO_INCORRECTO;
                }
                break;
            }
            $data = NULL;
        }
        return Response::json(
                        array(
                            'status'    => $status,
                            'data'      => $data,
                            'message'   => $mensaje
                        ),$status != 'OK' ? 500 : 200
                    );
    }

    /**
    *   this function allows to login the employee to the system
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      01/18/2015
    *   @version    1
    *   @access     public
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/empleados/login by post
    */
    public function acceder () {
        $inputs    = Input::all();
        $validador = Validator::make( $inputs , $this->validaciones_login );
        if ( !$validador->fails() ) {
            if( Auth::attempt( array( 'usuario' => $inputs['usuario'] , 'password' => $inputs['password'] ) , 
                true ) ) {
                $status   = OK;
                $data     = Empleado::where( 'id_empleado' , '=' , Auth::User()->id_empleado )
                                    ->first( $this->campos_root );
                $mensaje  = 'Login exitoso.';
            } else {
                $status   = LOGIN_FALLIDO;
                $data     = NULL;
                $mensaje  = 'Login fallido.';
            }
        } else {
            $mensajes = $validador->messages();
            foreach ( $mensajes->all() as $mensaje ){
                if( substr( $mensaje , 0 , 8 ) == 'required' ){
                    $status  = DATOS_INCOMPLETOS;
                    $mensaje = substr( $mensaje , 9 );
                }
                else{
                    $status  = FORMATO_INCORRECTO;
                }
                break;
            }
            $data = NULL;
        }
        return Response::json(
                        array(
                            'status'    => $status,
                            'data'      => $data,
                            'message'   => $mensaje
                        ),$status != 'OK' ? 500 : 200
                    );
    }

    /**
    *   this function allows to logout the employee from the system
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      01/18/2015
    *   @version    1
    *   @access     public
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/empleados/logout by post
    */
    public function salir () {
        if ( Auth::check() ) {
            Auth::logout();
            $status   = OK;
            $data     = NULL;
            $mensaje  = 'Logout exitoso.';
        } else {
            $status   = NO_PERMITIDO;
            $data     = NULL;
            $mensaje  = 'No has iniciado sesión.';
        }
        return Response::json(
                        array(
                            'status'    => $status,
                            'data'      => $data,
                            'message'   => $mensaje
                        ),$status != 'OK' ? 500 : 200
                    );
    }

    /**
    *   this function modify an employee the system already have
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      01/18/2015
    *   @version    1
    *   @access     public
    *   @param      Integer [$id_empleado] it's the id_empleado that reference which employee wants to modify
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/empleados by put
    */
    public function modificar ( $id_empleado = NULL) {
        Input::merge( 
                        array( 
                            'nombre'     => ucwords( strtolower( Input::get( 'nombre' ) ) ) , 
                            'apellidos'  => ucwords( strtolower( Input::get( 'apellidos' ) ) ),
                        ) 
                    );
        $inputs    = Input::all();
        $validador = Validator::make( $inputs , $this->validaciones );
        if ( !$validador->fails() ) {
            try {
                if( $id_empleado !== NULL ){
                    $empleado = Empleado::find( $id_empleado );
                } else {
                    $empleado = Empleado::find( Auth::User()->id_empleado );
                }
                DB::transaction( function() use ( $empleado , $inputs ) {
                    if ( array_key_exists( 'foto' , $inputs ) ) {
                        $imagen = new SimpleImage( $inputs['foto'] );
                        $imagen->resize( 110 , 110 );
                        $imagen->save( $inputs['foto'] );
                        $ruta_salida = explode( '.' , $inputs['foto'] )[0];
                        $extension   = explode( '.' , $inputs['foto'] )[1];
                        CircleCrop::circleCropImage($inputs['foto'],$ruta_salida.'.png');
                        if($extension != 'png'){
                            unlink($inputs['foto']);
                            $inputs['foto'] = $ruta_salida.'.png';
                        }
                    }
                    $empleado->update( $inputs );
                } );
                $status   = OK;
                $data     = NULL;
                $mensaje  = 'Empleado actualizado.';
            } catch ( Exception $e ) {
                $status  = ERROR_DB;
                $data    = NULL;
                $mensaje = 'Error al actualizar empleado.';
            }
        } else {
            $mensajes = $validador->messages();
            foreach ( $mensajes->all() as $mensaje ){
                if( substr( $mensaje , 0 , 8 ) == 'required' ){
                    $status  = DATOS_INCOMPLETOS;
                    $mensaje = substr( $mensaje , 9 );
                }
                else{
                    $status  = FORMATO_INCORRECTO;
                }
                break;
            }
            $data = NULL;
        }
        return Response::json(
                        array(
                            'status'    => $status,
                            'data'      => $data,
                            'message'   => $mensaje
                        ),$status != 'OK' ? 500 : 200
                    );
    }

    /**
    *   this function changes the employee's password
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      01/18/2015
    *   @version    1
    *   @access     public
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/empleados/changePassword by put
    */
    public function cambiar_password () {
        Input::merge( 
                        array( 
                            'password'   => Hash::make( Input::get( 'password' ) )
                        ) 
                    );
        $validaciones = array( 'password' => array( 'required' ) );
        $inputs       = Input::all();
        $validador    = Validator::make( $inputs , $validaciones );
        if ( !$validador->fails() ) {
            try {
                $empleado = Empleado::find( Auth::User()->id_empleado );
                $empleado->update( $inputs );
                $empleado->estatus = 1;
                $empleado->save();
                $status   = OK;
                $data     = Empleado::where( 'id_empleado' , '=' , Auth::User()->id_empleado )
                                    ->first( $this->campos_root );
                header('Content-Type: application/json');
                $mensaje  = 'Contraseña actualizada.';
            } catch ( Exception $e ) {
                $status  = ERROR_DB;
                $data    = NULL;
                $mensaje = 'Error al actualizar contraseña.';
            }
        } else {
            $mensajes = $validador->messages();
            foreach ( $mensajes->all() as $mensaje ){
                if( substr( $mensaje , 0 , 8 ) == 'required' ){
                    $status  = DATOS_INCOMPLETOS;
                    $mensaje = substr( $mensaje , 9 );
                }
                else{
                    $status  = FORMATO_INCORRECTO;
                }
                break;
            }
            $data = NULL;
        }
        return Response::json(
                        array(
                            'status'    => $status,
                            'data'      => $data,
                            'message'   => $mensaje
                        ),$status != 'OK' ? 500 : 200
                    );
    }

    /**
    *   this function shows the complete information from an employee
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      01/18/2015
    *   @version    1
    *   @access     public
    *   @param      Integer [$id_empleado] it's the id_empleado that reference which employee wants to see
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/empleados/4 by get
    */
    public function mostrar ( $id_empleado ) {
        $validaciones = array( 'id_empleado' => array( 'required' , 'integer') );
        $validador    = Validator::make( array( 'id_empleado' => $id_empleado ) , $validaciones );
        if ( !$validador->fails() ) {
            try {
                $empleado = Empleado::select( $this->campos )->find( $id_empleado );
                $status   = OK;
                $data     = $empleado;
                $mensaje  = '';
            } catch ( Exception $e ) {
                $status  = ERROR_DB;
                $data    = NULL;
                $mensaje = 'Error al mostrar datos del empleado.';
            }
        } else {
            $mensajes = $validador->messages();
            foreach ( $mensajes->all() as $mensaje ){
                if( substr( $mensaje , 0 , 8 ) == 'required' ){
                    $status  = DATOS_INCOMPLETOS;
                    $mensaje = substr( $mensaje , 9 );
                }
                else{
                    $status  = FORMATO_INCORRECTO;
                }
                break;
            }
            $data = NULL;
        }
        return Response::json(
                        array(
                            'status'    => $status,
                            'data'      => $data,
                            'message'   => $mensaje
                        ),$status != 'OK' ? 500 : 200
                    );
    }

    /**
    *   this function deletes the employee desired
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      01/24/2015
    *   @version    1
    *   @access     public
    *   @param      Integer [$id_empleado] it's the id_empleado that reference which employee wants to erase
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/empleados/1 by delete
    */
    public function eliminar ( $id_empleado ) {
        $validaciones = array( 'id_empleado' => array( 'required' , 'integer') );
        $validador    = Validator::make( array( 'id_empleado' => $id_empleado ) , $validaciones );
        if ( !$validador->fails() ) {
            try {
                $empleado = Empleado::find( $id_empleado );
                if( $empleado->eliminado == 'F' ) {
                    $empleado->eliminado = 'P';
                    $empleado->save();
                    $status   = OK;
                    $data     = NULL;
                    $mensaje  = 'Empleado eliminado.';
                } else {
                    $status   = NO_PERMITIDO;
                    $data     = NULL;
                    $mensaje  = 'No puedes llevar acabo esta operación, este empleado ya ha sido eliminado
                                 anteriormente.';
                }
            } catch ( Exception $e ) {
                $status  = ERROR_DB;
                $data    = NULL;
                $mensaje = 'Error al eliminar empleado.';
            }
        } else {
            $mensajes = $validador->messages();
            foreach ( $mensajes->all() as $mensaje ){
                if( substr( $mensaje , 0 , 8 ) == 'required' ){
                    $status  = DATOS_INCOMPLETOS;
                    $mensaje = substr( $mensaje , 9 );
                }
                else{
                    $status  = FORMATO_INCORRECTO;
                }
                break;
            }
            $data = NULL;
        }
        return Response::json(
                        array(
                            'status'    => $status,
                            'data'      => $data,
                            'message'   => $mensaje
                        ),$status != 'OK' ? 500 : 200
                    );
    }

    /**
    *   this function recovers the employee desired
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      01/24/2015
    *   @version    1
    *   @access     public
    *   @param      Integer [$id_empleado] it's the id_empleado that reference which employee wants to recover
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/empleados/recuperar/1 by get
    */
    public function recuperar ( $id_empleado ) {
        $validaciones = array( 'id_empleado' => array( 'required' , 'integer') );
        $validador    = Validator::make( array( 'id_empleado' => $id_empleado ) , $validaciones );
        if ( !$validador->fails() ) {
            try {
                $empleado = Empleado::find( $id_empleado );
                if( $empleado->eliminado == 'P' ) {
                    $empleado->eliminado = 'F';
                    $empleado->save();
                    $status   = OK;
                    $data     = NULL;
                    $mensaje  = 'Empleado recuperado.';
                } else {
                    $status   = NO_PERMITIDO;
                    $data     = NULL;
                    $mensaje  = 'No puedes llevar acabo esta operación, este empleado no ha sido eliminado
                                 anteriormente.';
                }
            } catch ( Exception $e ) {
                $status  = ERROR_DB;
                $data    = NULL;
                $mensaje = 'Error al recuperar empleado.';
            }
        } else {
            $mensajes = $validador->messages();
            foreach ( $mensajes->all() as $mensaje ){
                if( substr( $mensaje , 0 , 8 ) == 'required' ){
                    $status  = DATOS_INCOMPLETOS;
                    $mensaje = substr( $mensaje , 9 );
                }
                else{
                    $status  = FORMATO_INCORRECTO;
                }
                break;
            }
            $data = NULL;
        }
        return Response::json(
                        array(
                            'status'    => $status,
                            'data'      => $data,
                            'message'   => $mensaje
                        ),$status != 'OK' ? 500 : 200
                    );
    }

    /**
    *   this function lists all the employees available in the system if they are deleted or not
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      01/24/2015
    *   @version    1
    *   @access     public
    *   @param      Integer [$offset] it's the page in the table of the db that you want to show depending on result number by GET
    *   @param      Integer [$eliminado] it's a boolean flat that talks the function what kind of employees you want to show by GET
    *   @param      String [palabra_clave] it's word that works as a filter to the set of the records
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/empleados/listar/0/1 eliminados by post
    *   @example    http://localhost/zapateria/public/empleados/listar/0/0 no eliminados by post
    */
    public function listar ( $offset , $eliminado ) {
        $palabra_clave = Input::get('palabra_clave');
        $validaciones  = array( 
                               'offset'         => array( 'required' , 'integer' ),
                               'eliminado'      => array( 'required' , 'integer' ),
                               'palabra_clave'  => array( 'sometimes' , 'allow_all' )
                             );
        $validador    = Validator::make( 
                                        array( 
                                                'offset'        => $offset , 
                                                'eliminado'     => $eliminado , 
                                                'palabra_clave' => $palabra_clave 
                                            ) , $validaciones 
                                        );
        if ( !$validador->fails() ) {
            try {
                $empleados = Empleado::select( $this->campos_root )
                                     ->where( 'eliminado' , '=' , ( $eliminado == 0 ) ? 'F' : 'P' )
                                     ->where( 'id_empleado' , '<>' , Auth::User()->id_empleado );
                if( isset( $palabra_clave ) && $palabra_clave != '' ) {
                    $empleados->where( DB::raw( "CONCAT(nombre,' ',apellidos)" ) , 'LIKE' , "%$palabra_clave%");
                }
                $empleados = $empleados->take( NUM_RESULTADOS )
                                      ->skip( NUM_RESULTADOS*$offset )
                                      ->get();
                $status   = OK;
                $data     = $empleados;
                $mensaje  = '';
            } catch ( Exception $e ) {
                $status  = ERROR_DB;
                $data    = NULL;
                $mensaje = 'Error al listar datos de los empleados.';
            }
        } else {
            $mensajes = $validador->messages();
            foreach ( $mensajes->all() as $mensaje ){
                if( substr( $mensaje , 0 , 8 ) == 'required' ){
                    $status  = DATOS_INCOMPLETOS;
                    $mensaje = substr( $mensaje , 9 );
                }
                else{
                    $status  = FORMATO_INCORRECTO;
                }
                break;
            }
            $data = NULL;
        }
        return Response::json(
                        array(
                            'status'    => $status,
                            'data'      => $data,
                            'message'   => $mensaje
                        ),$status != 'OK' ? 500 : 200
                    );
    }
}