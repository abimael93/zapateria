<?php

class CatalogoController extends BaseController{

    /**
    *   this function returns a list of values depend on the type that someone had selected
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      01/22/2015
    *   @version    1
    *   @access     public
    *   @param      String [$tipo] it's the type of set tha you want to get
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/catalogos/producto_grupo by get
    */
    public function catalogos ( $tipo ) {
        $query   = NULL;
        $status  = OK;
        $mensaje = '';
        switch ( $tipo ) {
            case 'cargo':
                $query = Cargo::all();
                break;
            case 'departamento':
                $query = Departamento::all();
                break;
            case 'adjunto_tipo':
                $query = AdjuntoTipo::all();
                break;
            case 'ajuste_entrada_tipo':
                $query = AjusteEntradaTipo::all();
                break;
            case 'ajuste_salida_tipo':
                $query = AjusteSalidaTipo::all();
                break;
            case 'almacen':
                $query = Almacen::all();
                break;
            case 'cliente_tipo':
                $query = ClienteTipo::all();
                break;
            case 'cliente_categoria':
                $query = ClienteCategoria::all();
                break;
            case 'color':
                $query = Color::all();
                break;
            case 'familia':
                $query = Familia::all();
                break;
            case 'metadato':
                $query = Metadato::all();
                break;
            case 'movimiento_almacen_tipo':
                $query = MovimientoAlmacenTipo::all();
                break;
            case 'pago_condicion':
                $query = PagoCondicion::all();
                break;
            case 'pago_tipo':
                $query = PagoTipo::all();
                break;
            case 'producto_grupo':
                $query = ProductoGrupo::all();
                break;
            case 'producto_tipo':
                $query = ProductoTipo::all();
                break;
            case 'unidad_medida':
                $query = UnidadMedida::all();
                break;
            case 'pais':
                $query = Pais::all();
                break;
            default:
                # code...
                break;
        }
        return Response::json(
                        array(
                            'status'    => $status,
                            'data'      => $query,
                            'message'   => $mensaje
                        ),$status != 'OK' ? 500 : 200
                    );
    }

    /**
    *   this function returns a list of values depend on the type that someone has selected
    *   @author     Ramón Lozano <gerardo528-1@hotmail.com>
    *   @since      01/22/2015
    *   @version    1
    *   @access     public
    *   @param      String [$tipo] it's the type of set tha you want to get
    *   @param      Integer [$id] it's the filter for the differents kind of catalogs
    *   @return     json ( status = ? , data = ? , mensaje = ? )
    *   @example    http://localhost/zapateria/public/catalogos/dependientes/pais by get
    *   @example    http://localhost/zapateria/public/catalogos/dependientes/estado/1 by get
    */
    public function catalogosDepandientes ( $tipo , $id = NULL ) {
        $query   = NULL;
        $status  = OK;
        $mensaje = '';
        switch ( $tipo ) {
            case 'estado':
                $query = Estado::where( 'id_pais' , '=' , $id )->get();
                break;
            case 'municipio':
                $query = Municipio::where( 'id_estado' , '=' , $id )->get();
                break;
            case 'colonia':
                $query = Colonia::where( 'id_municipio' , '=' , $id )->get();
                break;
            default:
                # code...
                break;
        }
        return Response::json(
                        array(
                            'status'    => $status,
                            'data'      => $query,
                            'message'   => $mensaje
                        ),$status != 'OK' ? 500 : 200
                    );
    }
}