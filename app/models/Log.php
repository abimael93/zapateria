<?php

class Log extends Eloquent {
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
                                                'version',
                                            );
    protected static $relaciones    = array(
                                            );
}
?>