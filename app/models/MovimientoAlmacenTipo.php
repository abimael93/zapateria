<?php

class MovimientoAlmacenTipo extends Eloquent {
    use       Utiles;
    protected $table                = 'movimiento_almacen_tipo';
    protected $primaryKey           = 'id_movimiento_almacen_tipo';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                                'entrada_salida',
                                                'descripcion',
                                            );
    protected static $relaciones    = array(
                                                'movimiento_almacen',
                                            );

    public function movimiento_almacen () {
        return $this->hasMany('MovimientoAlmacen','id_movimiento_almacen_tipo');
    }
}
?>