<?php

class Pais extends Eloquent {
    use       Utiles;
    protected $table                = 'pais';
    protected $primaryKey           = 'id_pais';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                                'abrev',
                                            );
    protected static $relaciones    = array(
                                                'empleado',
                                            );

    public function empleado () {
        return $this->hasMany('Empleado','id_pais');
    }
}
?>