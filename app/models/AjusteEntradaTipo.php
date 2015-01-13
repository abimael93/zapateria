<?php

class AjusteEntradaTipo extends Eloquent {
    use         Utiles;
    protected   $table              = 'ajuste_entrada_tipo';
    protected   $primaryKey         = 'id_ajuste_entrada_tipo';
    public      $timestamps         = false;
    protected   $fillable           = array(
                                                'nombre',
                                                'exclusivo_sistema',
                                                'descripcion',
                                            );
    protected static $relaciones    = array(
                                                'ajuste_entrada',
                                            );
    
    public function ajuste_entrada () {
        return $this->hasMany('AjusteEntrada','id_ajuste_entrada_tipo');
    }
}
?>