<?php

class ClienteController extends BaseController{
    
    private $validaciones;
    private $campos_root;
    function __construct () {
        
        $this->validaciones = array(
                                'id_grupo_empresarial' => array( 'sometimes' , 'integer' ),
                                'id_cliente_categoria' => array( 'sometimes' , 'integer' ),
                                'id_cliente_tipo'      => array( 'sometimes' , 'integer' ),
                                'nombre'               => array( 'required' , 'alpha_spaces' ), 
                                'apellidos'            => array( 'required' , 'alpha_spaces' ),
                                'razon_social'         => array( 'sometimes' , 'allow_all' ),
                                'rfc'                  => array( 'sometimes' , 'alpha_num' ),               
                                'eliminado'            => array( 'sometimes' ),
                              );

        $this->campos_root = array(
                                    'id_cliente',
                                    'nombre',
                                    'apellidos',
                                    'razon_social',
                                    'fecha_registro'
                                  );
    }

    /**
    *   this function registers a client to the system
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      03/07/2015
    *   @version    1
    *   @access     public
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/clientes by post
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
                DB::transaction( function () use ( $inputs ) {
                    $cliente = new Cliente();
                    $cliente->create( $inputs );
                    if ( array_key_exists( 'metadatos' , $inputs ) ) {
                        MetadatoController::insertarMetadatos( $cliente , $inputs['metadatos'] );
                    }
                });
                $status    = OK;
                $data      = NULL;
                $mensaje   = 'Cliente registrado.';
            } catch ( Exception $e ) {
                echo $e;
                $status  = ERROR_DB;
                $data    = NULL;
                $mensaje = 'Error al insertar cliente.';
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
    *   this function modify a client the system already have
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      03/07/2015
    *   @version    1
    *   @access     public
    *   @param      Integer [$id_cliente] it's the id_cliente that reference which client wants to modify
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/clientes by put
    */
    public function modificar ( $id_cliente = NULL) {
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
                if( $id_cliente !== NULL ){
                    $cliente = Cliente::find( $id_cliente );
                } else {
                    throw new Exception( "El identificador del cliente esta vacio");
                }
                DB::transaction( function () use ( $inputs , $cliente ) {
                    $cliente->update( $inputs );
                    if ( array_key_exists( 'metadatos' , $inputs ) ) {
                        MetadatoController::insertarMetadatos( $cliente , $inputs['metadatos'] );
                    }
                });
                $status   = OK;
                $data     = NULL;
                $mensaje  = 'Cliente actualizado.';
            } catch ( Exception $e ) {
                $status  = ERROR_DB;
                $data    = NULL;
                $mensaje = 'Error al actualizar cliente.';
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
    *   this function shows the complete information from a client
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      03/07/2015
    *   @version    1
    *   @access     public
    *   @param      Integer [$id_cliente] it's the id_cliente that reference which client wants to see
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/clientes/4 by get
    */
    public function mostrar ( $id_cliente ) {
        $validaciones = array( 'id_cliente' => array( 'required' , 'integer') );
        $validador    = Validator::make( array( 'id_cliente' => $id_cliente ) , $validaciones );
        if ( !$validador->fails() ) {
            try {
                $cliente   = Cliente::find( $id_cliente );
                $status    = OK;
                $data      = $cliente;
                $mensaje   = '';
            } catch ( Exception $e ) {
                $status  = ERROR_DB;
                $data    = NULL;
                $mensaje = 'Error al mostrar datos del cliente.';
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
    *   this function deletes the client desired
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      03/07/2015
    *   @version    1
    *   @access     public
    *   @param      Integer [$id_cliente] it's the id_cliente that reference which client wants to erase
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/clientes/1 by delete
    */
    public function eliminar ( $id_cliente ) {
        $validaciones = array( 'id_cliente' => array( 'required' , 'integer') );
        $validador    = Validator::make( array( 'id_cliente' => $id_cliente ) , $validaciones );
        if ( !$validador->fails() ) {
            try {
                $cliente = Cliente::find( $id_cliente );
                if( $cliente->eliminado == 'F' ) {
                    $cliente->eliminado = 'P';
                    $cliente->save();
                    $status   = OK;
                    $data     = NULL;
                    $mensaje  = 'Cliente eliminado.';
                } else {
                    $status   = NO_PERMITIDO;
                    $data     = NULL;
                    $mensaje  = 'No puedes llevar acabo esta operación, este cliente ya ha sido eliminado
                                 anteriormente.';
                }
            } catch ( Exception $e ) {
                $status  = ERROR_DB;
                $data    = NULL;
                $mensaje = 'Error al eliminar cliente.';
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
    *   this function recovers the client desired
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      03/07/2015
    *   @version    1
    *   @access     public
    *   @param      Integer [$id_cliente] it's the id_cliente that reference which client wants to recover
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/clientes/recuperar/1 by get
    */
    public function recuperar ( $id_cliente ) {
        $validaciones = array( 'id_cliente' => array( 'required' , 'integer') );
        $validador    = Validator::make( array( 'id_cliente' => $id_cliente ) , $validaciones );
        if ( !$validador->fails() ) {
            try {
                $cliente = Cliente::find( $id_cliente );
                if( $cliente->eliminado == 'P' ) {
                    $cliente->eliminado = 'F';
                    $cliente->save();
                    $status   = OK;
                    $data     = NULL;
                    $mensaje  = 'Cliente recuperado.';
                } else {
                    $status   = NO_PERMITIDO;
                    $data     = NULL;
                    $mensaje  = 'No puedes llevar acabo esta operación, este cliente no ha sido eliminado
                                 anteriormente.';
                }
            } catch ( Exception $e ) {
                $status  = ERROR_DB;
                $data    = NULL;
                $mensaje = 'Error al recuperar cliente.';
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
    *   this function lists all the clients available in the system if they are deleted or not
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      03/07/2015
    *   @version    1
    *   @access     public
    *   @param      Integer [$offset] it's the page in the table of the db that you want to show depending on result number
    *   @param      Integer [$eliminado] it's a boolean flat that talks the function what kind of clients you want to show
    *   @param      String [palabra_clave] it's word that works as a filter to the set of the records
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/clientes/listar/0/1 eliminados by get
    *   @example    http://localhost/zapateria/public/clientes/listar/0/0 no eliminados by get
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
                $clientes = Cliente::select( $this->campos_root )
                                        ->where( 'eliminado' , '=' , ( $eliminado == 0 ) ? 'F' : 'P' );
                if( isset($palabra_clave) && $palabra_clave != '' ){
                    $clientes->where( DB::raw( "CONCAT(nombre,' ',apellidos)" ) , 'LIKE' , "%$palabra_clave%" );
                }
                $clientes = $clientes->take( NUM_RESULTADOS )
                                           ->skip( NUM_RESULTADOS*$offset )
                                           ->get();
                $status   = OK;
                $data     = $clientes;
                $mensaje  = '';
            } catch ( Exception $e ) {
                $status  = ERROR_DB;
                $data    = NULL;
                $mensaje = 'Error al listar datos de los clientes.';
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