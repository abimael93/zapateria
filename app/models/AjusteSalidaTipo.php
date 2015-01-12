<?php
/**  
 * Modelo Agencia
 * @author Alejandro(alejandro.duarte@corb.mx)
 */
class AjusteSalidaTipo extends Eloquent {
    use         Utiles;
    protected   $table              = 'ajuste_salida_tipo';
    protected   $primaryKey         = 'id_ajuste_salida_tipo';
    public      $timestamps         = false;
    protected   $fillable           = array(
                                                'nombre',
                                                'exclusivo_sistema',
                                                'descripcion',
                                            );
    protected static $relaciones    = array(
                                                'ajuste_salida',
                                            );
    /**
     * relacion entre agencia y proyecto
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param none
     * @return type: object
     * @access public
     */
    public function ajuste_salida () {
        return $this->hasMany('AjusteSalida','id_ajuste_salida_tipo');
    }
}
?>