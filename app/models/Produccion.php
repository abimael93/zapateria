<?php

class Produccion extends Eloquent {
    use Utiles;
    
    protected $table = 'produccion';

    protected $primaryKey           = 'id_produccion';
    public    $timestamps           = false;
    protected $fillable             = array(
                                               'id_pedido',
                                               'id_supervisor',
                                               'folio',
                                               'cantidad',
                                               'fecha_registro',
                                               'estatus',
                                               'eliminado',
                                           );
    protected static $relaciones    = array(
                                                'empleado',
                                                'producto',
                                                'pedido',
                                                'tarea',
                                            );

    public function empleado () {
        return $this->belongsTo('Empleado','id_supervisor');
    }

    public function producto () {
        return $this->belongsTo('Producto','id_producto');
    }

    public function pedido () {
        return $this->belongsTo('Pedido','id_pedido');
    }

    public function tarea () {
        return $this->hasMany('Tarea','id_produccion');
    }
}
?>