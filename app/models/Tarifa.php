<?php

class Tarifa extends Eloquent {
    use Utiles;
    protected $table                = 'tarifa';
    protected $primaryKey           = 'id_tarifa';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'descuento',
                                                'descripcion',
                                                'id_cliente_categoria',
                                                'id_cliente_tipo'
                                            );
    protected static $relaciones    = array(
                                                'cliente_categoria',
                                                'cliente_tipo',
                                                'cliente_rel_tarifa',
                                            );

    public function cliente_categoria () {
        return $this->belongsTo('ClienteCategoria','id_cliente_categoria');
    }

    public function cliente_tipo () {
        return $this->belongsTo('ClienteTipo','id_cliente_tipo');
    }

    public function cliente () {
        return $this->belongsToMany('Cliente','cliente_rel_tarifa','id_tarifa','id_cliente')->withPivot('observaciones');
    }
}
?>