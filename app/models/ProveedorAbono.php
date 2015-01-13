<?php

class ProveedorAbono extends Eloquent {
    use Utiles;
    protected $table                = 'proveedor_abono';
    protected $primaryKey           = 'id_proveedor_abono';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'folio',
                                                'monto',
                                                'id_proveedor',
                                                'id_pago_tipo',
                                                'fecha_registro',
                                            );
    protected static $relaciones    = array(
                                                'pago_tipo',
                                                'proveedor',
                                                'abono_rel_remision',
                                            );

    public function pago_tipo () {
        return $this->belongsTo('PagoTipo','id_pago_tipo');
    }

    public function proveedor () {
        return $this->belongsTo('Proveedor','id_proveedor');
    }

    public function recepcion () {
        return $this->belongsToMany('Recepcion','abono_rel_recepcion','id_proveedor_abono','id_recepcion')->withPivot('monto');
    }
}
?>