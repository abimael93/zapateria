<?php

class EmpleadoController extends BaseController{
    
    private $validaciones;
    private $validaciones_login;
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
    }

    /**
    *   this function registers a employee to the system
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
                $empleado = new Empleado();
                $empleado->create( $inputs );
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
                $data     = NULL;
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
    *   this function modify a employee the system already have
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      01/18/2015
    *   @version    1
    *   @access     public
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
                $empleado->update( $inputs );
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
                $data     = NULL;
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
    *   this function changes the employee's password
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      01/18/2015
    *   @version    1
    *   @access     public
    *   @param      Integer [$id_empleado] it's the id_empleado that refereces which employee wants to see
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/empleados/4 by get
    */
    public function mostrar ( $id_empleado ) {
        $validaciones = array( 'id_empleado' => array( 'required' , 'integer') );
        $validador    = Validator::make( array( 'id_empleado' => $id_empleado ) , $validaciones );
        if ( !$validador->fails() ) {
            try {
                $empleado = Empleado::find( $id_empleado );
                $empleado->cargo        = $empleado->cargo()->first()->nombre;
                $empleado->departamento = $empleado->departamento()->first()->nombre;
                $empleado->pais         = $empleado->pais()->first()->nombre;
                $empleado->estado       = $empleado->estado()->first()->nombre;
                $empleado->municipio    = $empleado->municipio()->first()->nombre;
                $empleado->colonia      = $empleado->colonia()->first()->nombre;
                unset( $empleado->usuario );
                $status   = OK;
                $data     = $empleado;
                $mensaje  = '';
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
}