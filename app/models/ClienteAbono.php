<?php

class ClienteAbono extends Eloquent {
    use Utiles;
    protected $table                = 'cliente_abono';
    protected $primaryKey           = 'id_cliente_abono';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'folio',
                                                'monto',
                                                'id_cliente',
                                                'id_pago_tipo',
                                                'fecha_registro',
                                            );
    protected static $relaciones    = array(
                                                'pago_tipo',
                                                'cliente',
                                                'abono_rel_remision',
                                            );

    public function pago_tipo () {
        return $this->belongsTo('PagoTipo','id_pago_tipo');
    }

    public function cliente () {
        return $this->belongsTo('Cliente','id_cliente');
    }

    public function remision () {
        return $this->belongsToMany('Remision','abono_rel_remision','id_cliente_abono','id_remision')->withPivot('monto');
    }
}
?>