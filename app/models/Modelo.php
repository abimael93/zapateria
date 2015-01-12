<?php

class Modelo extends Eloquent {
    use Utiles;
    
    protected $table = 'modelo';

    protected $primaryKey           = 'id_modelo';
    public    $timestamps           = false;
    protected $fillable             = array(
                                               'nombre',
                                               'precio_unitario',
                                               'estatus',
                                               'id_color',
                                               'id_unidad_medida',
                                               'id_producto_tipo',
                                               'fecha_registro',              
                                           );
    protected static $relaciones    = array(
                                                'color',
                                                'unidad_medida',
                                                'producto_tipo',
                                                'producto',
                                                'proceso_rel_modelo',
                                                'adjunto_rel_modelo',
                                                'modelo_rel_producto'
                                            );

    public function color () {
        return $this->belongsTo('Color','id_color');
    }

    public function unidad_medida () {
        return $this->belongsTo('UnidadMedida','id_unidad_medida');
    }

    public function producto_tipo () {
        return $this->belongsTo('ProductoTipo','id_producto_tipo');
    }

    public function producto () {
        return $this->hasMany('AjusteSalida','id_modelo');
    }

    public function proceso_rel_modelo () {
        return $this->belongsToMany('ProcesoRelModelo','proceso_rel_modelo','id_modelo','id_proceso_rel_modelo');     
    }

    public function adjunto_rel_modelo () {
        return $this->belongsToMany('AdjuntoRelModelo','adjunto_rel_modelo','id_modelo','id_adjunto_rel_modelo')->withPivot('principal');     
    }

    public function modelo_rel_producto () {
        return $this->belongsToMany('ModeloRelProducto','modelo_rel_producto','id_modelo','id_modelo_rel_producto')->withPivot('cantidad');     
    }
}
?>