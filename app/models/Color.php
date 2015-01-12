<?php

class Color extends Eloquent {
    use Utiles;
    protected $table                = 'color';
    protected $primaryKey           = 'id_color';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                                'descripcion',
                                            );
    protected static $relaciones    = array(
                                                'producto',
                                                'modelo',
                                            );

    public function producto () {
        return $this->hasMany('Producto','id_color');
    }

    public function modelo () {
        return $this->hasMany('Modelo','id_color');
    }
}
?>