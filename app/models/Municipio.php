<?php

class Municipio extends Eloquent {
    use       Utiles;
    protected $table                = 'municipio';
    protected $primaryKey           = 'id_municipio';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                            );
    protected static $relaciones    = array(
                                                'empleado',
                                            );

    public function empleado () {
        return $this->hasMany('Empleado','id_municipio');
    }
}
?>