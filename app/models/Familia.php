<?php

class Familia extends Eloquent {
    use Utiles;
    protected $table                = 'familia';
    protected $primaryKey           = 'id_familia';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'nombre',
                                                'descripcion'
                                            );
    protected static $relaciones    = array(
                                                'producto',
                                            );

    public function producto () {
        return $this->hasMany('Producto','id_familia');
    }
}
?>