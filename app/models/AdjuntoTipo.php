<?php
/**  
 * Modelo Agencia
 * @author Alejandro(alejandro.duarte@corb.mx)
 */
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
    /**
     * relacion entre agencia y proyecto
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param none
     * @return type: object
     * @access public
     */
    public function adjunto () {
        return $this->hasMany('Adjunto','id_adjunto_tipo');
    }
}
?>