<?php

class Cargo extends Eloquent {
    use       Utiles;
    protected $table                = 'cargo';
    protected $primaryKey           = 'id_cargo';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                                'descripcion',
                                            );
    protected static $relaciones    = array(
                                                'empleado',
                                            );

    public function empleado () {
        return $this->hasMany('Empleado','id_cargo');
    }
}
?>