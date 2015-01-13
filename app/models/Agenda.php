<?php

class Agenda extends Eloquent {
    use         Utiles;
    protected   $table              = 'agenda';
    protected   $primaryKey         = 'id_agenda';
    public      $timestamps         = false;
    protected   $fillable           = array(
                                                'id_objeto',
                                                'tipo_objeto',
                                                'objeto',
                                                'estatus',
                                                'fecha_calendario',
                                                'fecha_registro',
                                            );
    protected static $relaciones    = array(
                                            );
}
?>