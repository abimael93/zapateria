<?php

class Remision extends Eloquent {
    use       Utiles;
    protected $table                = 'remision';
    protected $primaryKey           = 'id_remision';
    public    $timestamps           = false;
    protected $fillable             = array(
                                               'folio',
                                               'total',
                                               'iva',
                                               'estatus',
                                               'id_movimiennto_almacen',
                                               'id_cliente',
                                               'fecha_registro',              
                                           );
    protected static $relaciones    = array(
                                                'movimiennto_almacen',
                                                'cliente',
                                                'cliente_abono',
                                                'producto',
                                            );

    public function movimiennto_almacen () {
        return $this->belongsTo('MovimientoAlmacen','id_movimiennto_almacen');
    }

    public function cliente () {
        return $this->belongsTo('Cliente','id_cliente');
    }
    
    public function cliente_abono () {
        return $this->belongsToMany('ClienteAbono','abono_rel_remision','id_remision','id_cliente_abono')->withPivot('monto');     
    }

    public function producto () {
        return $this->belongsToMany('Producto','remision_detalle','id_remision','id_producto')->withPivot('cantidad', 'precio_unitario', 'descuento');     
    }
}
?>  