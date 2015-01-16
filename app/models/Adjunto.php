<?php

class Adjunto extends Eloquent {
    use         Utiles;
    protected   $table              = 'adjunto';
    protected   $primaryKey         = 'id_adjunto';
    public      $timestamps         = false;
    protected   $fillable           = array(
                                                'nombre',
                                                'ruta',
                                                'fecha_registro',
                                                'id_adjunto_tipo',
                                            );
    protected static $relaciones    = array(
                                                'adjunto_tipo',
                                                'producto',
                                                'modelo',
                                                'adjunto_rel_produccion',
                                            );
    
    public function adjunto_tipo () {
        return $this->belongsTo('AdjuntoTipo','id_adjunto_tipo');
    }

    
    public function producto () {
        return $this->belongsToMany('Producto','producto_rel_adjunto','id_adjunto','id_producto')->withPivot('principal');
    }

    
    public function modelo () {
        return $this->belongsToMany('Modelo','adjunto_rel_modelo','id_adjunto','id_modelo')->withPivot('principal');
    }

    public function produccion () {
        return $this->belongsToMany('Produccion','adjunto_rel_produccion','id_adjunto','id_produccion')->withPivot('principal');
    }
}
?>