<?php

class Cliente extends Eloquent {
    use Utiles;
    
    protected $table = 'cliente';

    protected $primaryKey           = 'id_cliente';
    public    $timestamps           = false;
    protected $fillable             = array(
                                               'razon_social',
                                               'nombre',
                                               'apellidos',
                                               'rfc',
                                               'eliminado',
                                               'id_grupo_empresarial',
                                               'id_cliente_categoria',
                                               'id_cliente_tipo',
                                               'fecha_registro',              
                                           );
    protected static $relaciones    = array(
                                                'grupo_empresarial(cliente)',
                                                'cliente_categoria',
                                                'cliente_tipo',
                                                'cliente_rel_tarifa',
                                                'cliente_abono',              
                                                'remision',                 
                                                'pedido',
                                                'ajuste_entrada',
                                                'info_cliente',
                                            );

    public function grupo_empresarial () {
        return $this->hasMany('Cliente','id_grupo_empresarial');
    }

    public function cliente () {
        return $this->belongsTo('Cliente','id_cliente');
    }

    public function cliente_categoria () {
        return $this->belongsTo('ClienteCategoria','id_cliente_categoria');
    }

    public function cliente_tipo () {
        return $this->belongsTo('ClienteTipo','id_cliente_tipo');
    }

    public function cliente_rel_tarifa () {
        return $this->hasMany('ClienteRelTarifa','id_cliente');
    }

    public function cliente_abono () {
        return $this->hasMany('ClienteAbono','id_cliente');
    }

    public function remision () {
        return $this->hasMany('Remision','id_cliente');
    }

    public function pedido () {
        return $this->hasMany('Pedido','id_cliente');
    }

    public function ajuste_entrada () {
        return $this->hasMany('AjusteEntrada','id_cliente');
    }

    public function metadato () {
        return $this->belongsToMany('Metadato','info_cliente','id_cliente','id_metadato')->withPivot('valor', 'principal','conjunto');     
    }
}
?>