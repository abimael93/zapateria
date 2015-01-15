<?php

class Nota extends Eloquent {
    use       Utiles;
    protected $table                = 'nota';
    protected $primaryKey           = 'id_nota';
    public    $timestamps           = false;
    protected $fillable             = array(
                                                'id_objeto',
                                                'tipo_objeto',
                                                'id_autor',
                                                'comentario',
                                                'fecha_registro',
                                            );
    protected static $relaciones    = array(
                                            );
}
?>