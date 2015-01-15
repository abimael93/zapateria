<?php

class ReferenciaOrigen extends Eloquent {
    use         Utiles;
    protected   $table              = 'referencia_origen';
    protected   $primaryKey         = 'id_referencia_origen';
    public      $timestamps         = false;
    protected   $fillable           = array(
                                                'id_objeto_emisor',
                                                'tipo_objeto_emisor',
                                                'id_objeto_receptor',
                                                'tipo_objeto_receptor',
                                            );
    protected static $relaciones    = array(
                                            );
}
?>