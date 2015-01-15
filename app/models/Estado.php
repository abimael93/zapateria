<?php

class Estado extends Eloquent {
    use       Utiles;
    protected $table                = 'estado';
    protected $primaryKey           = 'id_estado';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                                'abrev',
                                                'id_pais',
                                            );
    protected static $relaciones    = array(
                                                'empleado',
                                                'municipio',
                                                'pais',
                                            );

    public function empleado () {
        return $this->hasMany('Empleado','id_estado');
    }

    public function municipio () {
        return $this->hasMany('Municipio','id_estado');
    }

    public function pais () {
        return $this->belongsTo('Pais','id_pais');
    }
}
?>