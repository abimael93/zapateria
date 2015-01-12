<?php

class Producto extends Eloquent {
    use Utiles;
    
    protected $table = 'modelo';

    protected $primaryKey           = 'id_producto';
    public    $timestamps           = false;
    protected $fillable             = array(
                                               'id_producto_padre',
                                               'nombre',
                                               'precio_unitario',
                                               'eliminado',
                                               'id_familia',
                                               'id_color',
                                               'id_producto_grupo',
                                               'id_unidad_medida',
                                               'id_producto_tipo',
                                               'id_talla',
                                               'id_modelo',
                                               'fecha_registro',              
                                           );
    protected static $relaciones    = array(
                                                'producto_padre',
                                                'familia',
                                                'color',
                                                'unidad_medida',
                                                'producto_tipo',
                                                'producto_grupo',
                                                'talla',
                                                'modelo',
                                                'remision',
                                                'recepcion',
                                                'ajuste_entrada',
                                                'ajuste_salida',
                                                'pedido',
                                                'orden_compra',
                                                'adjunto',
                                                'modelo',
                                                'almacen',
                                            );

    public function producto_padre () {
        return $this->hasMany('ProductoPadre','id_producto_padre');
    }

    public function producto () {
        return $this->belongsTo('Producto','id_producto');
    }

    public function familia () {
        return $this->belongsTo('Familia','id_familia');
    }

    public function color () {
        return $this->belongsTo('Color','id_color');
    }

    public function unidad_medida () {
        return $this->belongsTo('UnidadMedida','id_unidad_medida');
    }

    public function producto_tipo () {
        return $this->belongsTo('ProductoTipo','id_producto_tipo');     
    }

    public function talla () {
        return $this->belongsTo('Talla','id_talla');     
    }

    public function modelo () {
        return $this->belongsTo('Modelo','id_modelo');     
    }    

    public function remision () {
        return $this->belongsToMany('Remision','remision_detalle','id_producto','id_remision')->withPivot('cantidad', 'precio_unitario', 'descuento');     
    }

    public function recepcion () {
        return $this->belongsToMany('Recepcion','recepcion_detalle','id_producto','id_recepcion')->withPivot('cantidad', 'precio_unitario', 'descuento');     
    }

    public function ajuste_entrada () {
        return $this->belongsToMany('AjusteEntrada','ajuste_entrada_detalle','id_producto','id_ajuste_entrada')->withPivot('cantidad', 'precio_unitario', 'descuento');     
    }

    public function ajuste_salida () {
        return $this->belongsToMany('AjusteSalida','ajuste_salida_detalle','id_producto','id_ajuste_salida')->withPivot('cantidad', 'precio_unitario', 'descuento');     
    }

    public function pedido () {
        return $this->belongsToMany('Pedido','pedido_detalle','id_producto','id_pedido')->withPivot('principal');     
    }

    public function orden_compra () {
        return $this->belongsToMany('OrdenCompra','orden_compra_detalle','id_producto','id_orden_compra')->withPivot('principal');     
    }

    public function adjunto () {
        return $this->belongsToMany('Adjunto','adjunto_tipo','id_producto','id_adjunto')->withPivot('principal');     
    }

    public function modelo_rel_producto () {
        return $this->belongsToMany('Modelo','modelo_rel_producto','id_producto','id_modelo')->withPivot('cantidad');     
    }

    public function almacen () {
        return $this->belongsToMany('Almacen','existencia','id_producto','id_almacen')->withPivot('valor', 'principal','conjunto');     
    }
}
?>  