<?php

class ClienteTipo extends Eloquent {
    use Utiles;
    protected $table                = 'cliente_tipo';
    protected $primaryKey           = 'id_cliente_tipo';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                                'descripcion',
                                            );
    protected static $relaciones    = array(
                                                'tarifa',
                                                'cliente',
                                            );

    public function tarifa () {
        return $this->hasMany('Tarifa','id_cliente_tipo');
    }

    public function cliente () {
        return $this->hasMany('Cliente','id_cliente_tipo');
    }
}
?>