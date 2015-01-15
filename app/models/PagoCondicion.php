<?php

class PagoCondicion extends Eloquent {
    use       Utiles;
    protected $table                = 'pago_condicion';
    protected $primaryKey           = 'id_pago_condicion';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                                'descripcion',
                                            );
    protected static $relaciones    = array(
                                                'pedido',
                                                'orden_compra'
                                            );

    public function pedido () {
        return $this->hasMany('Pedido','id_pago_condicion');
    }

    public function orden_compra () {
        return $this->hasMany('OrdenCompra','id_pago_condicion');
    }
}
?>