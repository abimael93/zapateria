<?php

class Produccion extends Eloquent {
    use Utiles;
    
    protected $table = 'produccion';

    protected $primaryKey           = 'id_produccion';
    public    $timestamps           = false;
    protected $fillable             = array(
                                               'id_pedido_detalle',
                                               'id_supervisor',
                                               'folio',
                                               'cantidad',
                                               'fecha_registro',
                                               'estatus',
                                               'eliminado',
                                           );
    protected static $relaciones    = array(
                                                'empleado',
                                                'pedido',
                                                'tarea',
                                            );

    public function empleado () {
        return $this->belongsTo('Empleado','id_supervisor');
    }

    public function tarea () {
        return $this->hasMany('Tarea','id_produccion');
    }
    
    public function Pedido () {
        return $this->belongsToMany('Pedido','pedido_detalle','id_produccion','id_pedido')->withPivot('cantidad', 'precio_unitario','descuento');     
    }
}
?>