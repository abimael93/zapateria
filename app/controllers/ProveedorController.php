<?php

class ProveedorController extends BaseController{
    
    private $validaciones;
    private $campos_root;
    function __construct () {
        
        $this->validaciones = array(
                                'nombre'            => array( 'required' , 'alpha_spaces' ), 
                                'apellidos'         => array( 'required' , 'alpha_spaces' ),
                                'razon_social'      => array( 'required' , 'allow_all' ),
                                'rfc'               => array( 'sometimes' , 'alpha_num' ),               
                                'eliminado'         => array( 'sometimes' ),
                              );

        $this->campos_root = array(
                                    'id_proveedor',
                                    'nombre',
                                    'apellidos',
                                    'fecha_registro'
                                  );
    }

    /**
    *   this function registers a supplier to the system
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      01/31/2015
    *   @version    1
    *   @access     public
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/proveedores by post
    */
    public function registrar () {
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
                $proveedor = new Proveedor();
                $proveedor->create( $inputs );
                $status    = OK;
                $data      = NULL;
                $mensaje   = 'Proveedor registrado.';
            } catch ( Exception $e ) {
                $status  = ERROR_DB;
                $data    = NULL;
                $mensaje = 'Error al insertar proveedor.';
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
    *   this function modify a supplier the system already have
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      01/31/2015
    *   @version    1
    *   @access     public
    *   @param      Integer [$id_proveedor] it's the id_proveedor that reference which supplier wants to modify
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/proveedores by put
    */
    public function modificar ( $id_proveedor = NULL) {
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
                if( $id_proveedor !== NULL ){
                    $proveedor = Proveedor::find( $id_proveedor );
                } else {
                    $proveedor = Proveedor::find( Auth::User()->id_proveedor );
                }
                $proveedor->update( $inputs );
                $status   = OK;
                $data     = NULL;
                $mensaje  = 'Proveedor actualizado.';
            } catch ( Exception $e ) {
                $status  = ERROR_DB;
                $data    = NULL;
                $mensaje = 'Error al actualizar proveedor.';
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
    *   this function shows the complete information from a supplier
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      01/31/2015
    *   @version    1
    *   @access     public
    *   @param      Integer [$id_proveedor] it's the id_proveedor that reference which supplier wants to see
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/proveedores/4 by get
    */
    public function mostrar ( $id_proveedor ) {
        $validaciones = array( 'id_proveedor' => array( 'required' , 'integer') );
        $validador    = Validator::make( array( 'id_proveedor' => $id_proveedor ) , $validaciones );
        if ( !$validador->fails() ) {
            try {
                $proveedor = Proveedor::find( $id_proveedor );
                $status    = OK;
                $data      = $proveedor;
                $mensaje   = '';
            } catch ( Exception $e ) {
                $status  = ERROR_DB;
                $data    = NULL;
                $mensaje = 'Error al mostrar datos del proveedor.';
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
    *   this function deletes the supplier desired
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      01/31/2015
    *   @version    1
    *   @access     public
    *   @param      Integer [$id_proveedor] it's the id_proveedor that reference which supplier wants to erase
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/proveedores/1 by delete
    */
    public function eliminar ( $id_proveedor ) {
        $validaciones = array( 'id_proveedor' => array( 'required' , 'integer') );
        $validador    = Validator::make( array( 'id_proveedor' => $id_proveedor ) , $validaciones );
        if ( !$validador->fails() ) {
            try {
                $proveedor = Proveedor::find( $id_proveedor );
                if( $proveedor->eliminado == 'F' ) {
                    $proveedor->eliminado = 'P';
                    $proveedor->save();
                    $status   = OK;
                    $data     = NULL;
                    $mensaje  = 'Proveedor eliminado.';
                } else {
                    $status   = NO_PERMITIDO;
                    $data     = NULL;
                    $mensaje  = 'No puedes llevar acabo esta operación, este proveedor ya ha sido eliminado
                                 anteriormente.';
                }
            } catch ( Exception $e ) {
                $status  = ERROR_DB;
                $data    = NULL;
                $mensaje = 'Error al eliminar proveedor.';
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
    *   this function recovers the supplier desired
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      01/31/2015
    *   @version    1
    *   @access     public
    *   @param      Integer [$id_proveedor] it's the id_proveedor that reference which supplier wants to recover
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/proveedores/recuperar/1 by get
    */
    public function recuperar ( $id_proveedor ) {
        $validaciones = array( 'id_proveedor' => array( 'required' , 'integer') );
        $validador    = Validator::make( array( 'id_proveedor' => $id_proveedor ) , $validaciones );
        if ( !$validador->fails() ) {
            try {
                $proveedor = Proveedor::find( $id_proveedor );
                if( $proveedor->eliminado == 'P' ) {
                    $proveedor->eliminado = 'F';
                    $proveedor->save();
                    $status   = OK;
                    $data     = NULL;
                    $mensaje  = 'Proveedor recuperado.';
                } else {
                    $status   = NO_PERMITIDO;
                    $data     = NULL;
                    $mensaje  = 'No puedes llevar acabo esta operación, este proveedor no ha sido eliminado
                                 anteriormente.';
                }
            } catch ( Exception $e ) {
                $status  = ERROR_DB;
                $data    = NULL;
                $mensaje = 'Error al recuperar proveedor.';
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
    *   this function lists all the suppliers available in the system if they are deleted or not
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      01/31/2015
    *   @version    1
    *   @access     public
    *   @param      Integer [$offset] it's the page in the table of the db that you want to show depending on result number
    *   @param      Integer [$eliminado] it's a boolean flat that talks the function what kind of suppliers you want to show
    *   @param      String [palabra_clave] it's word that works as a filter to the set of the records
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/proveedores/listar/0/1 eliminados by get
    *   @example    http://localhost/zapateria/public/proveedores/listar/0/0 no eliminados by get
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
                $proveedores = Proveedor::select( $this->campos_root )
                                        ->where( 'eliminado' , '=' , ( $eliminado == 0 ) ? 'F' : 'P' );
                if( isset($palabra_clave) && $palabra_clave != '' ){
                    $proveedores->where( DB::raw( "CONCAT(nombre,' ',apellidos)" ) , 'LIKE' , "%$palabra_clave%" );
                }
                $proveedores = $proveedores->take( NUM_RESULTADOS )
                                           ->skip( NUM_RESULTADOS*$offset )
                                           ->get();
                $status   = OK;
                $data     = $proveedores;
                $mensaje  = '';
            } catch ( Exception $e ) {
                $status  = ERROR_DB;
                $data    = NULL;
                $mensaje = 'Error al listar datos de los proveedores.';
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