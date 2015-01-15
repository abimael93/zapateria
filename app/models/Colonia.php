<?php

class Colonia extends Eloquent {
    use       Utiles;
    protected $table                = 'colonia';
    protected $primaryKey           = 'id_colonia';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                                'id_municipio'
                                            );
    protected static $relaciones    = array(
                                                'empleado',
                                                'municipio'
                                            );

    public function empleado () {
        return $this->hasMany('Empleado','id_colonia');
    }

    public function municipio () {
        return $this->belongsTo('Municipio','id_municipio');
    }
}
?>