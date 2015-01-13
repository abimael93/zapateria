<?php

class UnidadMedida extends Eloquent {
    use Utiles;
    protected $table                = 'unidad_medida';
    protected $primaryKey           = 'id_unidad_medida';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                                'descripcion',
                                            );
    protected static $relaciones    = array(
                                                'producto',
                                                'modelo'
                                            );

    public function modelo () {
        return $this->hasMany('Modelo','id_unidad_medida');
    }

    public function producto () {
        return $this->hasMany('Producto','id_unidad_medida');
    }
}
?>