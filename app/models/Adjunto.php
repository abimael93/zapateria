<?php
/**  
 * Modelo Agencia
 * @author Alejandro(alejandro.duarte@corb.mx)
 */
class Adjunto extends Eloquent {
    use         Utiles;
    protected   $table              = 'adjunto';
    protected   $primaryKey         = 'id_adjunto';
    public      $timestamps         = false;
    protected   $fillable           = array(
                                                'nombre',
                                                'ruta',
                                                'fecha_registro',
                                            );
    protected static $relaciones    = array(
                                                'adjunto_tipo',
                                                'producto',
                                                'modelo',
                                            );
    /**
     * relacion entre agencia y proyecto
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param none
     * @return type: object
     * @access public
     */
    public function adjunto_tipo () {
        return $this->belongsTo('AdjuntoTipo','id_adjunto_tipo');
    }

    /**
     * relacion entre agencia y broker
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param none
     * @return type: object
     * @access public
     */
    public function producto () {
        return $this->belongsToMany('Producto','producto_rel_adjunto','id_adjunto','id_producto')->withPivot('principal');
    }

    /**
     * relacion entre agencia y broker
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param none
     * @return type: object
     * @access public
     */
    public function modelo () {
        return $this->belongsToMany('Modelo','adjunto_rel_modelo','id_adjunto','id_modelo')->withPivot('principal');
    }
}
?>