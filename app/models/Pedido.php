<?php

class Pedido extends Eloquent {
    use Utiles;
    protected $table                = 'pedido';
    protected $primaryKey           = 'id_pedido';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'folio',
                                                'iva',
                                                'estatus',
                                                'eliminado',
                                                'id_cliente',
                                                'id_empleado',
                                                'id_pago_condicion',
                                                'fecha_registro',
                                            );
    protected static $relaciones    = array(
                                                'cliente',
                                                'empleado',
                                                'pago_condicion',
                                                'pedido_detalle'
                                            );

    public function cliente () {
        return $this->belongsTo('Cliente','id_cliente');
    }

    public function empleado () {
        return $this->belongsTo('Empleado','id_empleado');
    }

    public function pago_condicion () {
        return $this->belongsTo('PagoCondicion','id_pago_condicion');
    }

    public function producto () {
        return $this->belongsToMany('Producto','pedido_detalle','id_pedido','id_producto');
    }
}
?>