<?php

class ProductoGrupo extends Eloquent {
    use       Utiles;
    protected $table                = 'producto_grupo';
    protected $primaryKey           = 'id_producto_grupo';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                                'descripcion'
                                            );
    protected static $relaciones    = array(
                                                'producto',
                                                'modelo',
                                            );

    public function producto () {
        return $this->hasMany('Producto','id_producto_grupo');
    }

    public function modelo () {
        return $this->hasMany('Modelo','id_producto_grupo');
    }
}
?>