<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Empleado extends Eloquent implements UserInterface, RemindableInterface {
	use Utiles;
	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'empleado';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token','usuario');

	protected $primaryKey    		= 'id_empleado';
    public 	  $timestamps		 	= false;
    protected $fillable 	 		= array(
											   'nombre',
											   'apellidos',
				                               'rfc',
				                               'foto',
				                               'correo',
				                               'usuario',
				                               'password',
				                               'eliminado',
				                               'calle',
				                               'num_int',
				                               'num_ext',
				                               'telefono',
				                               'celular',
				                               'id_cargo',
				                               'id_departamento',
				                               'id_pais',
				                               'id_estado',
				                               'id_municipio',
				                               'id_colonia',
				                               'fecha_registro',
				                               'estatus',
										   );
	protected static $relaciones    = array(
												'municipio',
												'pais',
												'departamento',
												'cargo',
												'colonia',
												'orden_compra',
												'movimiento_almacen',
												'tarea',
												'produccion',
												'pedido',
											);

	public function estado () {
		return $this->belongsTo('Estado','id_estado');
	}

	public function municipio () {
		return $this->belongsTo('Municipio','id_municipio');
	}

	public function pais () {
		return $this->belongsTo('Pais','id_pais');
	}

	public function departamento () {
		return $this->belongsTo('Departamento','id_departamento');
	}

	public function cargo () {
		return $this->belongsTo('Cargo','id_cargo');
	}

	public function colonia () {
		return $this->belongsTo('Colonia','id_colonia');
	}

	public function orden_compra () {
		return $this->hasMany('OrdenCompra','id_empleado');
	}

	public function movimiento_almacen () {
		return $this->hasMany('MovimientoAlmacen','id_empleado');
	}

	public function tarea () {
		return $this->hasMany('Tarea','id_empleado');
	}

	public function produccion () {
		return $this->hasMany('Produccion','id_empleado');
	}

	public function pedido () {
		return $this->hasMany('Pedido','id_empleado');
	}
}
?>