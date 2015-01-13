<?php

class log extends Eloquent {
    use         Utiles;
    protected   $table              = 'log';
    protected   $primaryKey         = 'id_log';
    public      $timestamps         = false;
    protected   $fillable           = array(
                                                'id_objeto',
                                                'id_autor',
                                                'tag',
                                                'tipo_objeto',
                                                'comentario',
                                                'datos_antes',
                                                'datos_despues',
                                                'agrupado',
                                                'fecha_registro',
                                            );
    protected static $relaciones    = array(
                                            );
}
?>