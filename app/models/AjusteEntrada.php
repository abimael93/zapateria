<?php

class AjusteEntrada extends Eloquent {
    use         Utiles;
    protected   $table              = 'ajuste_entrada';
    protected   $primaryKey         = 'id_ajuste_entrada';
    public      $timestamps         = false;
    protected   $fillable           = array(
                                                'folio',
                                                'id_movimiento_almacen',
                                                'id_ajuste_entrada_tipo',
                                                'id_cliente',
                                                'feha_registro',
                                            );
    protected static $relaciones    = array(
                                                'movimiento_almacen',
                                                'ajuste_entrada_tipo',
                                                'cliente',
                                                'producto',
                                            );
    
    public function movimiento_almacen () {
        return $this->belongsTo('MovimientoAlmacen','id_movimiento_almacen');
    }

    public function ajuste_entrada_tipo () {
        return $this->belongsTo('AjusteEntradaTipo','id_ajuste_entrada_tipo');
    }
    
    public function cliente () {
        return $this->belongsTo('cliente','id_cliente');
    }

    public function producto () {
        return $this->belongsToMany('Producto','ajuste_entrada_detalle','id_ajuste_entrada','id_producto')->withPivot('cantidad','precio_unitario','descuento');
    }
}
?>