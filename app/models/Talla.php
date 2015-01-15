<?php

class Talla extends Eloquent {
    use       Utiles;
    protected $table                = 'talla';
    protected $primaryKey           = 'id_talla';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                                'descripcion',
                                                'id_producto_tipo',
                                            );
    protected static $relaciones    = array(
                                                'producto',
                                                'producto_tipo',
                                            );

    public function producto () {
        return $this->hasMany('Producto','id_talla');
    }

    public function producto_tipo () {
        return $this->belongsTo('ProductoTipo','id_producto_tipo');
    }
}
?>