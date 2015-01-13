<?php

class OrdenCompra extends Eloquent {
    use         Utiles;
    protected   $table              = 'orden_compra';
    protected   $primaryKey         = 'id_orden_compra';
    public      $timestamps         = false;
    protected   $fillable           = array(
                                                'folio',
                                                'iva',
                                                'estatus',
                                                'eliminado',
                                                'fecha_registro',
                                            );
    protected static $relaciones    = array(
                                                'proveedor',
                                                'empleado',
                                                'pago_condicion',
                                            );
    public function proveedor () {
        return $this->belongsTo('Proveedor','id_proveedor');
    }

    public function empleado () {
        return $this->belongsTo('Empleado','id_empleado');
    }

    public function pago_condicion () {
        return $this->belongsTo('PagoCondicion','id_pago_condicion');
    }

    public function producto () {
        return $this->belongsToMany('Producto,orden_compra_detalle,id_orden_compra,id_producto')->withPivot('cantidad','precio_unitario','descuento');
    }
}
?>