<?php

class Almacen extends Eloquent {
    use       Utiles;
    protected $table                = 'almacen';
    protected $primaryKey           = 'id_almacen';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                            );
    protected static $relaciones    = array(
                                                'movimiento_almacen',
                                                'existencia',
                                                'producto',
                                            );

    public function movimiento_almacen () {
        return $this->hasMany('MovimientoAlmacen','id_almacen');
    }

    public function producto () {
        return $this->belongsToMany('Producto','existencia','id_almacen','id_producto')->withPivot('precio_unitario','cantidad','fecha_registro');
    }
}
?>