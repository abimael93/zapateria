<?php

class Departamento extends Eloquent {
    use Utiles;
    protected $table                = 'departamento';
    protected $primaryKey           = 'id_departamento';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                            );
    protected static $relaciones    = array(
                                                'empleado',
                                            );

    public function empleado () {
        return $this->hasMany('Empleado','id_departamento');
    }
}
?>