<?php

class Proveedor extends Eloquent {
    use       Utiles;
    protected $table = 'proveedor';
    protected $primaryKey           = 'id_proveedor';
    public    $timestamps           = false;
    protected $fillable             = array(
                                               'razon_social',
                                               'nombre',
                                               'apellidos',
                                               'rfc',
                                               'eliminado',
                                               'fecha_registro',              
                                           );
    protected static $relaciones    = array(
                                                'proveedor_abono',
                                                'orden_compra',
                                                'recepcion',
                                                'ajuste_salida',
                                                'info_proveedor',
                                            );

    public function proveedor_abono () {
        return $this->hasMany('ProveedorAbono','id_proveedor');
    }

    public function orden_compra () {
        return $this->hasMany('OrdenCompra','id_proveedor');
    }

    public function recepcion () {
        return $this->hasMany('Recepcion','id_proveedor');
    }

    public function ajuste_salida () {
        return $this->hasMany('AjusteSalida','id_proveedor');
    }

    public function metadato () {
        return $this->belongsToMany('Metadato','info_proveedor','id_proveedor','id_metadato')->withPivot('valor', 'principal','conjunto');     
    }
}
?>