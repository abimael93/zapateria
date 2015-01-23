<?php

class PagoTipo extends Eloquent {
    use       Utiles;
    protected $table                = 'pago_tipo';
    protected $primaryKey           = 'id_pago_tipo';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                                'descripcion',
                                            );
    protected static $relaciones    = array(
                                                'cliente_abono',
                                                'proveedor_abono'
                                            );

    public function cliente_abono () {
        return $this->hasMany('ClienteAbono','id_pago_tipo');
    }

    public function proveedor_abono () {
        return $this->hasMany('ProveedorAbono','id_pago_tipo');
    }
}
?>