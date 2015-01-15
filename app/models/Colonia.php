<?php

class Colonia extends Eloquent {
    use       Utiles;
    protected $table                = 'colonia';
    protected $primaryKey           = 'id_colonia';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                            );
    protected static $relaciones    = array(
                                                'empleado',
                                            );

    public function empleado () {
        return $this->hasMany('Empleado','id_colonia');
    }
}
?>