<?php

class Pais extends Eloquent {
    use       Utiles;
    protected $table                = 'pais';
    protected $primaryKey           = 'id_pais';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                            );
    protected static $relaciones    = array(
                                                'empleado',
                                                'estado',
                                            );

    public function empleado () {
        return $this->hasMany('Empleado','id_pais');
    }

    public function estado () {
        return $this->hasMany('Estado','id_pais');
    }
}
?>