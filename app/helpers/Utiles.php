<?php
trait Utiles{
    /**
     * Se encarga de hacer todas las consultas a las tablas definidas en el modelo
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param data: array
     * @return type: array
     * @access public
     */
    public static function agregarRelaciones($data=NULL){
        if( $data !== NULL ){
            $respuesta[with(new static)->getTable()] = $data;   
        }
        foreach(self::$relaciones as $tabla){
            $respuesta[$tabla]  = DB::select("select * from $tabla;");
        }
        return $respuesta;
    }
    
    /**
     * Se encarga de buscar un valor mediante el atributo del array entregado
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param datos:array,atributo: string, atributo2: string, valor:string,valor2:string
     * @return type: array
     * @access public
     */
    public static function obtenerPor($datos,$atributo,$valor,$atributo2 = NULL,$valor2 = NULL){
        $resultado = NULL;
        if( !empty($datos) &&  $valor !== NULL){
            foreach($datos as $dato){
                if( $atributo2 === NULL && $valor2 === NULL ){
                    if( strval(get_object_vars($dato)["$atributo"])  === strval($valor) ){
                        $resultado[] = (object)$dato;
                    }
                }
                else if( $atributo2 !== NULL && $valor2 !== NULL ){
                    if( strval(get_object_vars($dato)["$atributo"])  === strval($valor) &&  strval(get_object_vars($dato)["$atributo2"])  === strval($valor2)){
                        $resultado[] = (object)$dato;
                    }
                }
            }
        }
        if( count($resultado) === 1 ){
            $resultado = $resultado[0];
        }
        return $resultado;
    }
    public static function obtenerNombreTabla($modelo){
        return with($modelo)->getTable();
    }
    /**
     * Se encarga de entregar los datos necesarios de los metadatos 
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param objetos:object
     * @return type: json{status:?,data:?,mensaje:?}
     * @access public
     */
    public static function obtiene_metadatos($objetos){
        $metadatos = array();
        foreach($objetos as $objeto){

            if( ($objeto->pivot->valor !== '' && (int)$objeto->pivot->valor !== 0 && $objeto->pivot->valor !== NULL) || $objeto->plural =='Antigüedad'){
                if(((int)$objeto->pivot->valor)==1){
                    $objeto->nombre = $objeto->singular;
                }else if($objeto->plural!==''){
                    $objeto->nombre = $objeto->plural;
                }else{
                    $objeto->nombre = $objeto->singular;
                }
                if($objeto->tipo_dato == 'checkbox'){
                    $objeto->pivot->valor=-1;
                }
                if($objeto->nombre === NULL){
                    $objeto->nombre = $objeto->singular;
                }
                if(isset($objeto->id_propiedad)){
                    $propiedad     = Propiedad::find($objeto->id_propiedad);
                    $tipo_inmueble = TipoInmueble::join('tipos_inmuebles_rel_metadatos','tipos_inmuebles_rel_metadatos.id_tipo_inmueble','=','tipos_inmuebles.id_tipo_inmueble')
                                                ->where('tipos_inmuebles_rel_metadatos.id_tipo_inmueble','=',$propiedad->id_tipo_inmueble)
                                                ->where('tipos_inmuebles_rel_metadatos.id_metadato','=',$objeto->id_metadato)->first();
                    if(isset($tipo_inmueble)){
                        if($tipo_inmueble->obligatorio == 1){
                            $metadatos['principales'][] = array(
                                            'id_metadato'  => $objeto->id_metadato,
                                            'nombre'       => $objeto->nombre,
                                            'valor'        => $objeto->pivot->valor,
                                            'principal'    => $objeto->pivot->principal
                                        );
                        }else{
                            $metadatos['secundarios'][] = array(
                                            'id_metadato'  => $objeto->id_metadato,
                                            'nombre'       => $objeto->nombre,
                                            'valor'        => $objeto->pivot->valor,
                                            'principal'    => $objeto->pivot->principal
                                        );
                        }
                    }
                }else{
                    $metadatos[] = array(
                                        'id_metadato'  => $objeto->id_metadato,
                                        'nombre'       => $objeto->nombre,
                                        'valor'        => $objeto->pivot->valor,
                                        'principal'    => $objeto->pivot->principal
                                        );
                }
            }

        }
        return $metadatos;
    }
    /**
     * Se encarga de quitar los inputs que estan con cadena vacia
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param array: inputs
     * @return type: json{status:?,data:?,mensaje:?}
     * @access public
     */
    public static function limpiarInputs($inputs){
        foreach($inputs as $key => $input){
            if( $input === '' ){
                unset($inputs[$key]);
            }
        }
        return $inputs;
    }
    
    /**
     * obtener un dato especifico de la tabla intermedia entre dos relaciones
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param tabla_relacionada: string,pivote:string
     * @return type: json{status:?,data:?,mensaje:?}
     * @access public
     */
	public function obtenerPivote($tabla_relacionada,$pivote){
		$tabla = with(new static)->getTable();
        DB::select("select $pivote from $tabla_relacionada");
	}
    /**
     * Se encarga de ordenar los indices empezando desde el numero 0
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param datos: array
     * @return array
     * @access public
     */
	public static function cambiarIndices($datos){
		$contador = 0;
        $respuesta = array();
		foreach($datos as $dato){
			$respuesta[$contador] = $dato;
            $contador++;
		}
        return $respuesta;
	}
    /**
     * Se encarga de ecnontrar una relacion en una tabla intermedia
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param datos: array,atributo1: string,atributo2: string, id1:int,id2:int
     * @return array
     * @access public
     */
    public static function existeRelacion($datos,$atributo1,$id1,$atributo2,$id2){
		
		if(!empty($datos)){
			foreach($datos as $dato){
				$dato = (array)$dato;
				if((int)$dato[$atributo1] === (int)$id1 && (int)$dato[$atributo2] === (int)$id2){
					return true;
				}
			}
		}
		return false;
	}

    /**
     * Se encarga de agregar un pais no existente en el sistema asignandole su padre dejandolo como pendiente
     * @author por Ramon(ramon.lozano@corb.mx)
     * @param string $nombre
     * @param integer $comfirmado
     * @return integer
     * @access private
     */
    public static function agregarPais($nombre,$comfirmado=0){
        $pais = Pais::where('nombre','LIKE',"%$nombre%")
                        ->where('pendiente','=',0)->first();
        if($pais === NULL){
            $pais = new Pais();
        }
        $pais->nombre = $nombre;
        $pais->pendiente = !$comfirmado;
        $pais->save();
        return (int)$pais->id_pais;
    }


    /**
     * Se encarga de agregar un estado no existente en el sistema asignandole su padre dejandolo como pendiente o como comfirmado
     * @author por Ramon(ramon.lozano@corb.mx)
     * @param integer $id_pais
     * @param string $nombre
     * @param integer $comfirmado
     * @return integer
     * @access private
     */
    public static function agregarEstado($id_pais,$nombre,$comfirmado=0){
        $estado = Estado::where('nombre','LIKE',"%$nombre%")
                        ->where('pendiente','=',1)->first();
        if($estado === NULL){
            $estado = new Estado();
        }
        $estado->nombre = $nombre;
        $estado->pendiente = !$comfirmado;
        $estado->id_pais = $id_pais;
        $estado->save();
        return (int)$estado->id_estado;
    }


    /**
     * Se encarga de agregar un municipioque no existente en el sistema asignandole su padre dejandolo como pendiente o como comfirmado
     * @author por Ramon(ramon.lozano@corb.mx)
     * @param integer $id_estado
     * @param string $nombre
     * @param integer $comfirmado
     * @return integer
     * @access private
     */
    public static function agregarMunicipio($id_estado,$nombre,$comfirmado=0){
        $municipio = Municipio::where('nombre','LIKE',"%$nombre%")
                        ->where('pendiente','=',1)->first();
        if($municipio === NULL){
            $municipio = new Municipio();
        }
        $municipio->nombre = $nombre;
        $municipio->pendiente = !$comfirmado;
        $municipio->id_estado = $id_estado;
        $municipio->save();
        return (int)$municipio->id_municipio;
    }

    /**
     * Se encarga de agregar una colonia no existente en el sistema asignandole su padre dejandolo como pendiente o como comfirmado
     * @author por Ramon(ramon.lozano@corb.mx)
     * @param integer $id_municipio
     * @param string $nombre
     * @param integer $comfirmado
     * @return integer
     * @access private
     */
    public static function agregarColonia($id_municipio,$nombre,$comfirmado=0){
        $colonia = Colonia::where('nombre','LIKE',"%$nombre%")
                        ->where('pendiente','=',1)->first();
        if($colonia === NULL){
            $colonia = new Colonia();
        }
        $colonia->nombre = $nombre;
        $colonia->pendiente = !$comfirmado;
        $colonia->id_municipio = $id_municipio;
        $colonia->save();
        return (int)$colonia->id_colonia;
    }

    /**
     * Se encarga de agregar un codigo postal no existente en el sistema dejandolo como pendiente o como comfirmado
     * @author por Ramon(ramon.lozano@corb.mx)
     * @param integer $id_municipio
     * @param string $nombre
     * @param integer $comfirmado
     * @return integer
     * @access private
     */
    public static function agregarCodigoPostal($nombre,$comfirmado=0){
        $codigoPostal = new CodigoPostal();
        $codigoPostal->codigo = $nombre;
        $codigoPostal->pendiente = !$comfirmado;
        $codigoPostal->save();
        return (int)$codigoPostal->id_codigo_postal;
    }
    
    /**
     * Se encarga de comparar dos arrays y regresa lo que no concuerda
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param datas1:array,datas2:array
     * @return integer
     * @access public
     */
    public static function comparar($datas1,$datas2){//funcion recursiva
        $datas1  = (array) $datas1;
        
        
        $diferencias = [];
        foreach($datas1 as $key => $data1){
            
            if(is_object($data1) ){
                $data1  = (array)$data1;
            }
            
            if(array_key_exists($key,$datas2)){
                if(is_object($datas2[$key]) ){
                    $datas2[$key]  = (array)$datas2[$key];
                }
                if(is_array($data1) && !empty($datas2[$key]) && $key !=='propiedades_relacionadas'){
                    
                    $temp           = Utiles::comparar($data1,$datas2[$key]);
                    if(!empty($temp)){
                        $diferencias[$key] = $temp;
                    }
                }
                else if( $data1 !== $datas2[$key] && $key !=='propiedades_relacionadas' && !is_numeric($key) ){

                    $diferencias[]= $key;
            
                }
            }
            else{
                if(is_numeric($key)){
                    $diferencias[]  = null;
                } 
                else if(is_array($data1)){
                    
                    $diferencias[]  = $key;
  
                }
                else {
                    $diferencias[]= $key;
                }
            }
        }
        return $diferencias;
    }
    /**
     * Se encarga de comparar dos arrays y regresa lo que no concuerda
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param datas1:array,datas2:array
     * @return integer
     * @access public
     */
    public static function diff($datas1,$datas2){
        $datas1 = (array)$datas1;
        $datas2 = (array)$datas2;

        foreach($datas1 as $key=>$data1){
             if(array_key_exists($key,$datas2)){
                if( $data1 !== $datas2[$key] && $key !=='propiedades_relacionadas' && $key !=='proyectos_relacionados'){
					//dd($datas1, $datas2);
                    if($key === 'metadatos' && array_key_exists($key,$datas2)){
                        foreach($data1 as $key2=> $data){
							try{
								$data = (array)$data;
								
								if(array_key_exists($key2,$datas2[$key])){
									$datas2[$key][$key2] = (array)$datas2[$key][$key2];
									if($data['valor']!== $datas2[$key][$key2]['valor']){
										$temp[] = $data['nombre'];    
									}
								}
								
							}
							catch(Exception $e){
								echo($e->getMessage()."<br>Linea: ".$e->getLine());
							}
                            
                        }
                        if(!empty($temp)){
                               $diferencias[] = array('metadatos'=>$temp);
                        }
                    }
                    else{
                       $diferencias[] = $key;
                    }
                   
                }
             }
             else{
                $diferencias[] = $key;
             }
        }
        return $diferencias;
    }
    /**
     * Se encarga de obtener brokers compartidos
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param tipo:string, id:int
     * @return integer
     * @access public
     */
    public static function obtenerCompartidos($tipo,$id){
        if($tipo === 'P' ){
            $propiedad = Propiedad::find($id);
            $brokers= $propiedad->broker()->where('propiedades_rel_brokers.compartido','=',true)->get();
        }
        else if($tipo === 'Y' ){
            $proyecto = Proyecto::find($id);
            $brokers= $proyecto->broker()->where('proyectos_rel_brokers.compartido','=',true)->get();
        }
        return $brokers;
    }
	
	
    /**
     * Se encarga de saber cuantos tipos metadatos hay, cuando hay uno repetido lo ignora
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param metadatos: array
     * @return integer
     * @access public
     */
    public static function contarMetadatos($metadatos){
        $cont = 0;
        $pivote = 0;
        foreach($metadatos as $metadato){
            $metadato = (object)$metadato;
            if($metadato->id_metadato !== $pivote && !Utiles::esDomicilio($metadato->id_metadato) && !Utiles::esRedSocial($metadato->id_metadato)){
                $cont++;
            }
        }
        return $cont;
    }
    /**
     * Saber si el id_metadato es parte de un metadato considerado como domicilio
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param id_metadato: int
     * @return bool
     * @access public
     */
    public static function esDomicilio($id_metadato){
        $id_metadato = (int)$id_metadato;
        switch($id_metadato){
            case 2 : case 8 : case 9: case 50: case 51: case 52: case 53:
                return true;
            default:
                return false;
        }
    }
    
    /**
     * Saber si es una red social
     * @author por Alejandro(alejandro.duarte@corb.mx)
     * @param id_metadato: int
     * @return bool
     * @access public
     */
    public static function esRedSocial($id_metadato){
        $id_metadato = (int)$id_metadato;
        switch($id_metadato){
            case 48 : case 49 : 
                return true;
            default:
                return false;
        }
    }
    
    /*
     * regresa las diferencias entre dos arreglos (cosas que array1 tienes que array2 no) 
     * y si tiene arreglos dentro de el busca
     * @author por Ramon(ramon.lozano@corb.mx)
     * @param $aArray1, $aArray2 array
     * @return bool
     * @access public
     */
    public static function arrayRecursiveDiff($aArray1, $aArray2) {
        if($aArray2 === NULL){
            $aArray2 = array();
        }
        $aReturn = array();
             foreach ($aArray1 as $mKey => $mValue) {
                 if (array_key_exists($mKey, $aArray2)) {
                if (is_array($mValue)) {
                    $aRecursiveDiff = Utiles::arrayRecursiveDiff($mValue, $aArray2[$mKey]);
                    if (count($aRecursiveDiff)) { 
                        $aReturn[$mKey] = $aRecursiveDiff; 
                    }
                } else {
                    if ($mValue != $aArray2[$mKey]) {
                     $aReturn[$mKey] = $mValue;
                    }
                }
            } else {
                $aReturn[$mKey] = $mValue;
            }
        }
        return $aReturn;
    } 

    public static function compararIdsAdjuto($adjunto1,$adjunto2){
        if($adjunto1['id_adjunto'] == $adjunto2['id_adjunto']){
            return 0;
        }
        return ($adjunto1['id_adjunto'] < $adjunto2['id_adjunto'])? -1 : 1 ;
    }
}

?>