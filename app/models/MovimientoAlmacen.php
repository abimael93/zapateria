<?php

class MovimientoAlmacen extends Eloquent {
    use         Utiles;
    protected   $table              = 'movimiento_almacen';
    protected   $primaryKey         = 'id_movimiento_almacen';
    public      $timestamps         = false;
    protected   $fillable           = array(
                                                'fecha_registro',
                                                'referencia',
                                                'id_empleado',
                                                'id_movimiento_almacen_tipo',
                                                'id_almacen',
                                            );
    protected static $relaciones    = array(
                                                'empleado',
                                                'almacen',
                                                'movimiento_almacen_tipo',
                                            );
    
    public function empleado () {
        return $this->belongsTo('Empleado','id_empleado');
    }

    public function almacen () {
        return $this->belongsTo('Almacen','id_almacen');
    }

    public function movimiento_almacen_tipo () {
        return $this->belongsTo('MovimientoAlmacenTipo','id_movimiento_almacen_tipo');
    }

    public function remision () {
        return $this->hasMany('Remision','id_movimiento_almacen');
    }

    public function recepcion () {
        return $this->hasMany('Recepcion','id_movimiento_almacen');
    }

    public function ajuste_entrada () {
        return $this->hasMany('AjusteEntrada','id_movimiento_almacen');
    }

    public function ajuste_salida () {
        return $this->hasMany('AjusteSalida','id_movimiento_almacen');
    }
}
?>