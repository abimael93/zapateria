<?php

class Modelo extends Eloquent {
    use       Utiles;
    protected $table                = 'modelo';
    protected $primaryKey           = 'id_modelo';
    public    $timestamps           = false;
    protected $fillable             = array(
                                               'nombre',
                                               'precio_unitario',
                                               'estatus',
                                               'id_color',
                                               'id_unidad_medida',
                                               'id_producto_tipo',
                                               'id_producto_grupo',
                                               'fecha_registro',              
                                           );
    protected static $relaciones    = array(
                                                'color',
                                                'unidad_medida',
                                                'producto_tipo',
                                                'producto_grupo',
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

    public function producto_grupo () {
        return $this->belongsTo('ProductoGrupo','id_producto_grupo');
    }

    public function producto () {
        return $this->hasMany('Producto','id_modelo');
    }

    public function proceso () {
        return $this->belongsToMany('Proceso','proceso_rel_modelo','id_modelo','id_proceso');
    }

    public function adjunto () {
        return $this->belongsToMany('Adjunto','adjunto_rel_modelo','id_modelo','id_adjunto')->withPivot('principal');     
    }

    public function modelo_rel_producto () {
        return $this->belongsToMany('Producto','modelo_rel_producto','id_modelo','id_producto')->withPivot('cantidad');     
    }
}
?>