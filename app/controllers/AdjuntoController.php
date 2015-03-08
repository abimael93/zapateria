<?php

class AdjuntoController extends BaseController{
    private $validaciones;

    function __construct () {
        
        $this->validaciones = array(
                                'archivo'          => array( 'required' , 'image' ),
                            );
    }
    public function subir () {
        $archivo   = Input::file( 'archivo' );
        $validador = Validator::make( array( 'archivo' => $archivo ) , $this->validaciones );
        if ( !$validador->fails() ) {
            $fecha = date( 'd-m-Y' );
            if ( $archivo->isValid() ) {
                if( !is_dir( ARCHIVOS ) ){
                    exec( 'mkdir -m 777 '.ARCHIVOS );
                    if ( !is_dir( ARCHIVOS.'/'.$fecha ) ) {
                        exec( 'mkdir -m 777 '.ARCHIVOS.'/'.$fecha );
                    }
                } else {
                    if ( !is_dir( ARCHIVOS.'/'.$fecha ) ) {
                        exec( 'mkdir -m 777 '.ARCHIVOS.'/'.$fecha );
                    }
                }
                $random = str_random( 3 ).rand( 1 , 99 );
                $archivo->move( ARCHIVOS.'/'.$fecha , 
                                date( 'd-m-Y_G-i-s' ).$random.'.'.$archivo->getClientOriginalExtension() );
                $data    = array(
                                    'nombre'            => $archivo->getClientOriginalName(),
                                    'ruta'              => ARCHIVOS.'/'.$fecha.'/',
                                    'nombre_servidor'   => date( 'd-m-Y_G-i-s' ).$random.'.'.$archivo->getClientOriginalExtension()
                                );
                $status  = OK;
                $mensaje = 'Imagen cargada.';
            } else {
                $status  = ARCHIVO_INVALIDO;
                $mensaje = 'Archivo invalido.';
                $data    = NULL;
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