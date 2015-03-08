<?php

class MetadatoController extends BaseController{
    
    public static function insertarMetadatos ( $objeto , $metadatos ) {
        if ( property_exists( $objeto , 'id_cliente' ) ) {
            $tabla   = 'info_cliente';
            $columna = 'id_info_cliente';
        } else if ( property_exists( $objeto , 'id_proveedor' ) ) {
            $tabla   = 'info_proveedor';
            $columna = 'id_info_proveedor';
        }
        foreach ( $metadatos as $metadato => $arreglos ) {
            if ( $metadato == 'domicilios' ) {
                $domicilios = $arreglos;
                if ( isset( $conjunto   = DB::table( $tabla )
                                            ->whereNotNull( 'conjunto' )
                                            ->orderBy( $columna )
                                            ->first( array( 'conjunto' ) ) ) ) {
                    $conjunto = $conjunto->conjunto;
                } else {
                    $conjunto = 0;
                }
                foreach ( $domicilios as $domicilio ) {
                    foreach ( $domicilio as $domicilio_parte => $valores ) {
                        $llaves = implode( ',' , array_keys( $valores ) );
                        if ( strpos( 'id_info' , $llaves ) === false ) {
                            $objeto->actializarPivote( $tabla , $columna , $valores[$columna] , 
                                                        array( 
                                                                'valor'     => $valores['valor'] ,
                                                                'principal' => $valores['principal'],
                                                             )
                                                     );
                        } else {
                            $objeto->metadato()->attach( $valores['id_metadato'] , 
                                                         array( 
                                                                'valor'     => $valores['valor'] ,
                                                                'principal' => $valores['principal'],
                                                                'conjunto'  => $conjunto
                                                             )
                                                       );
                        }
                    }
                    $conjunto++;
                }
            } else {
                foreach ( $arreglos as $valores ) {
                    $llaves = implode( ',' , array_keys( $valores ) );
                    if ( strpos( 'id_info' , $llaves ) === false ) {
                        $objeto->actializarPivote( $tabla , $columna , $valores[$columna] , 
                                                    array( 
                                                            'valor'     => $valores['valor'] ,
                                                            'principal' => $valores['principal'],
                                                         )
                                                 );
                    } else {
                        $objeto->metadato()->attach( $valores['id_metadato'] , 
                                                     array( 
                                                            'valor'     => $valores['valor'] ,
                                                            'principal' => $valores['principal'],
                                                         )
                                                   );
                    }
                }
            }
        }
    }

    
}