<?php

class Metadato extends Eloquent {
    use Utiles;
    protected $table                = 'metadato';
    protected $primaryKey           = 'id_metadato';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                                'singular',
                                                'plural',
                                                'tipo_dato',
                                            );
    protected static $relaciones    = array(
                                                'info_proveedor',
                                                'info_cliente',
                                            );

    public function proveedor () {
        return $this->belongsToMany('Proveedor','info_proveedor','id_metadato','id_proveedor')->withPivot('valor','principal','conjunto');
    }

    public function cliente () {
        return $this->belongsToMany('Cliente','info_cliente','id_metadato','id_cliente')->withPivot('valor','principal','conjunto');
    }
}
?>