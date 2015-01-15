<?php

class Recepcion extends Eloquent {
    use       Utiles;
    protected $table                = 'recepcion';
    protected $primaryKey           = 'id_recepcion';
    public    $timestamps           = false;
    protected $fillable             = array(
                                               'folio',
                                               'total',
                                               'iva',
                                               'estatus',
                                               'id_movimiennto_almacen',
                                               'id_proveedor',
                                               'id_empleado',
                                               'fecha_registro',              
                                           );
    protected static $relaciones    = array(
                                                'movimiennto_almacen',
                                                'proveedor',
                                                'empleado',
                                                'proveedor_abono',
                                                'producto',
                                            );

    public function movimiennto_almacen () {
        return $this->belongsTo('MovimientoAlmacen','id_movimiennto_almacen');
    }

    public function proveedor () {
        return $this->belongsTo('Proveedor','id_proveedor');
    }

    public function empleado () {
        return $this->belongsTo('Empleado','id_empleado');
    }
    
    public function proveedor_abono () {
        return $this->belongsToMany('ProveedorAbono','abono_rel_remision','id_recepcion','id_proveedor_abono')->withPivot('monto');     
    }
    public function producto () {
        return $this->belongsToMany('Producto','recepcion_detalle','id_recepcion','id_producto')->withPivot('cantidad', 'precio_unitario', 'descuento');     
    }
}
?>  