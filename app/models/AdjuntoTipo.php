<?php

class AdjuntoTipo extends Eloquent {
    use         Utiles;
    protected   $table              = 'adjunto_tipo';
    protected   $primaryKey         = 'id_adjunto_tipo';
    public      $timestamps         = false;
    protected   $fillable           = array(
                                                'nombre',
                                            );
    protected static $relaciones    = array(
                                                'adjunto',
                                            );
    
    public function adjunto () {
        return $this->hasMany('Adjunto','id_adjunto_tipo');
    }
}
?>