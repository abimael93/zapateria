<?php
/**  
 * Modelo Agencia
 * @author Alejandro(alejandro.duarte@corb.mx)
 */
class AjusteSalida extends Eloquent {
    use         Utiles;
    protected   $table              = 'ajuste_salida';
    protected   $primaryKey         = 'id_ajuste_salida';
    public      $timestamps         = false;
    protected   $fillable           = array(
                                                'folio',
                                                'id_movimiento_almacen',
                                                'id_ajuste_salida_tipo',
                                                'id_cliente',
                                                'feha_registro',
                                            );
    protected static $relaciones    = array(
                                                'movimiento_almacen',
                                                'ajuste_salida_tipo',
                                                'cliente',
                                            );
    /**
     * relacion entre agencia y proyecto
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param none
     * @return type: object
     * @access public
     */
    public function movimiento_almacen () {
        return $this->belongsTo('MovimientoAlmacen','id_movimiento_almacen');
    }

    /**
     * relacion entre agencia y proyecto
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param none
     * @return type: object
     * @access public
     */
    public function ajuste_salida_tipo () {
        return $this->belongsTo('AjusteSalidaTipo','id_ajuste_salida_tipo');
    }

    /**
     * relacion entre agencia y proyecto
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param none
     * @return type: object
     * @access public
     */
    public function cliente () {
        return $this->belongsTo('cliente','id_cliente');
    }

    /**
     * relacion entre agencia y broker
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param none
     * @return type: object
     * @access public
     */
    public function producto () {
        return $this->belongsToMany('Producto','ajuste_salida_detalle','id_ajuste_salida','id_producto')->withPivot('cantidad','precio_unitario','descuento');
    }
}
?>