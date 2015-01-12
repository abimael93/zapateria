<?php

class Tarea extends Eloquent {
    use Utiles;
    
    protected $table = 'tarea';

    protected $primaryKey           = 'id_tarea';
    public    $timestamps           = false;
    protected $fillable             = array(
                                               'id_tarea_padre',
                                               'id_empleado',
                                               'id_proceso',
                                               'id_produccion',
                                               'estatus',
                                               'estatus',
                                               'eliminado',
                                               'fecha_registro',              
                                           );
    protected static $relaciones    = array(
                                                'tarea_padre'
                                                'tarea'
                                                'proceso',
                                                'empleado',
                                                'produccion',
                                            );

    public function tarea_padre () {
        return $this->hasMany('Tarea','id_tarea_padre');
    }

    public function tarea () {
        return $this->belongsTo('Tarea','id_tarea');
    }

    public function proceso () {
        return $this->belongsTo('Proceso','id_tarea');
    }

    public function empleado () {
        return $this->belongsTo('Empleado','id_tarea');
    }

    public function produccion () {
        return $this->belongsTo('Produccion','id_tarea');
    }
}
?>