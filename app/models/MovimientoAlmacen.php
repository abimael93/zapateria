<?php
/**  
 * Modelo Agencia
 * @author Alejandro(alejandro.duarte@corb.mx)
 */
class MovimientoAlmacen extends Eloquent {
    use         Utiles;
    protected   $table              = 'movimiento_almacen';
    protected   $primaryKey         = 'id_movimiento_almacen';
    public      $timestamps         = false;
    protected   $fillable           = array(
                                                'fecha_registro',
                                                'referencia',
                                            );
    protected static $relaciones    = array(
                                                'empleado',
                                                'almacen',
                                                'movimiento_almacen_tipo',
                                            );
    /**
     * relacion entre agencia y proyecto
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param none
     * @return type: object
     * @access public
     */
    public function empleado () {
        return $this->belongsTo('Empleado','id_empleado');
    }

    /**
     * relacion entre agencia y proyecto
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param none
     * @return type: object
     * @access public
     */
    public function almacen () {
        return $this->belongsTo('Almacen','id_almacen');
    }

    /**
     * relacion entre agencia y proyecto
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param none
     * @return type: object
     * @access public
     */
    public function movimiento_almacen_tipo () {
        return $this->belongsTo('MovimientoAlmacenTipo','id_movimiento_almacen_tipo');
    }

    /**
     * relacion entre agencia y proyecto
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param none
     * @return type: object
     * @access public
     */
    public function remision () {
        return $this->hasMany('Remision','id_movimiento_almacen');
    }

    /**
     * relacion entre agencia y proyecto
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param none
     * @return type: object
     * @access public
     */
    public function recepcion () {
        return $this->hasMany('Recepcion','id_movimiento_almacen');
    }

    /**
     * relacion entre agencia y proyecto
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param none
     * @return type: object
     * @access public
     */
    public function ajuste_entrada () {
        return $this->hasMany('AjusteEntrada','id_movimiento_almacen');
    }

    /**
     * relacion entre agencia y proyecto
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param none
     * @return type: object
     * @access public
     */
    public function ajuste_salida () {
        return $this->hasMany('AjusteSalida','id_movimiento_almacen');
    }
}
?>