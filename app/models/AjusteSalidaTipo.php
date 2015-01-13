<?php

class AjusteSalidaTipo extends Eloquent {
    use         Utiles;
    protected   $table              = 'ajuste_salida_tipo';
    protected   $primaryKey         = 'id_ajuste_salida_tipo';
    public      $timestamps         = false;
    protected   $fillable           = array(
                                                'nombre',
                                                'exclusivo_sistema',
                                                'descripcion',
                                            );
    protected static $relaciones    = array(
                                                'ajuste_salida',
                                            );
    
    public function ajuste_salida () {
        return $this->hasMany('AjusteSalida','id_ajuste_salida_tipo');
    }
}
?>