<?php

class ProductoTipo extends Eloquent {
    use Utiles;
    protected $table                = 'producto_tipo';
    protected $primaryKey           = 'id_producto_tipo';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                            );
    protected static $relaciones    = array(
                                                'talla',
                                                'producto',
                                                'modelo',
                                            );

    public function talla () {
        return $this->hasMany('Talla','id_producto_tipo');
    }

    public function producto () {
        return $this->hasMany('Producto','id_producto_tipo');
    }

    public function modelo () {
        return $this->hasMany('Modelo','id_producto_tipo');
    }
}
?>