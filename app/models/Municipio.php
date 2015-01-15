<?php

class Municipio extends Eloquent {
    use       Utiles;
    protected $table                = 'municipio';
    protected $primaryKey           = 'id_municipio';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                                'id_estado',
                                            );
    protected static $relaciones    = array(
                                                'empleado',
                                                'colonia',
                                                'estado'
                                            );

    public function empleado () {
        return $this->hasMany('Empleado','id_municipio');
    }

    public function colonia () {
        return $this->hasMany('Colonia','id_municipio');
    }

    public function estado () {
        return $this->belongsTo('Estado','id_estado');
    }
}
?>