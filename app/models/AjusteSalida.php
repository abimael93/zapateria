<?php

class AjusteSalida extends Eloquent {
    use         Utiles;
    protected   $table              = 'ajuste_salida';
    protected   $primaryKey         = 'id_ajuste_salida';
    public      $timestamps         = false;
    protected   $fillable           = array(
                                                'folio',
                                                'id_movimiento_almacen',
                                                'id_ajuste_salida_tipo',
                                                'id_proveedor',
                                                'feha_registro',
                                            );
    protected static $relaciones    = array(
                                                'movimiento_almacen',
                                                'ajuste_salida_tipo',
                                                'proveedor',
                                                'producto',
                                            );
    
    public function movimiento_almacen () {
        return $this->belongsTo('MovimientoAlmacen','id_movimiento_almacen');
    }

    public function ajuste_salida_tipo () {
        return $this->belongsTo('AjusteSalidaTipo','id_ajuste_salida_tipo');
    }

    public function proveedor () {
        return $this->belongsTo('Proveedor','id_proveedor');
    }

    public function producto () {
        return $this->belongsToMany('Producto','ajuste_salida_detalle','id_ajuste_salida','id_producto')->withPivot('cantidad','precio_unitario','descuento');
    }
}
?>