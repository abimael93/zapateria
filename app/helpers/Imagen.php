<?php
class Imagen extends SimpleImage{

    public $altura_maxima=290;
    public $anchura_maxima=490;


    protected $thumbnails_size=array(
                        array('anchura'=>250, 'altura'=>200),
                        array('anchura'=>300, 'altura'=>300),
                        array('anchura'=>256, 'altura'=>154),
                        array('anchura'=>100, 'altura'=>100),
                        array('anchura'=>120, 'altura'=>150),
                    );
    /**
     * Genera imagenes miniatura de la imagen actual
     * @param	string	$ruta			Ruta base donde se guardaran las imagenes
     * @param	string	$nombre_base	Nombre con el que seran guardadas las imagenes
     * @param	Array	$tam    		Arreglo que contiene los tamaños de los thumbnails a generar, si no se especifica utilizara los tamaños predefinidos
     * @author Gabriel <gabriel.ortiz@corb.mx>
     */
    public function generaThumbnails($ruta, $nombre_base, $tams=null){

        if(!file_exists($ruta)){
            exec('mkdir -m 777 '.ARCHIVOS.'/'.$ruta);
        }

        if($tams===null){
            $tams = $this->thumbnails_size;
        }

        foreach($tams as $tam){
            $ruta_final = $ruta.'/'.$tam['anchura'].'x'.$tam['altura'];
            if(!file_exists($tam['anchura'].'x'.$tam['altura'])){
                exec('mkdir -m 777 '.ARCHIVOS.'/'.$ruta_final);
            }
            $nombre= ARCHIVOS.'/'.$ruta_final.'/'.$nombre_base;
            //$this->resize($tam['anchura'], $tam['altura']);
            $this->thumbnail($tam['anchura'], $tam['altura']);
            $this->save($nombre);
        }
    }

    /**
     * Genera imagenes miniatura de la imagen actual con sus crops circulares para el pay
     * @param   string  $ruta           Ruta base donde se guardaran las imagenes
     * @param   string  $nombre_base    Nombre con el que seran guardadas las imagenes
     * @param   Array   $tam            Arreglo que contiene los tamaños de los thumbnails a generar, si no se especifica utilizara los tamaños predefinidos
     * @author Ramon <ramon.lozano@corb.mx>
     */
    public function generaThumbnailsPerfil($ruta, $nombre_base, $tams=null){
        $mascaras = array('12-5.png','25.png','37-5.png','50.png','62-5.png','75.png','87-5.png');
        if(!file_exists($ruta)){
            exec('mkdir -m 777 '.ARCHIVOS.'/'.$ruta);
        }

        if($tams===null){
            $tams = $this->thumbnails_size;
        }
        foreach($tams as $tam){
            $ruta_final = $ruta.'/'.$tam['anchura'].'x'.$tam['altura'];
            if(!file_exists($tam['anchura'].'x'.$tam['altura'])){
                exec('mkdir -m 777 '.ARCHIVOS.'/'.$ruta_final);
            }
            $nombre= ARCHIVOS.'/'.$ruta_final.'/'.$nombre_base;
            $imagen = new Imagen(ARCHIVOS.'/'.$nombre_base);
            $imagen->thumbnail($tam['anchura'], $tam['altura']);
            $imagen->save($nombre);
            if($tam['anchura'] == 80 && $tam['altura'] == 80){
                $i=0;
                $nombre_real = explode('.',$nombre)[0];
                $tam_mask = count($mascaras);
                for($i=0;$i < $tam_mask;$i++) {
                    $copia_imagen = new Imagen(ARCHIVOS.'/'.$nombre_base);
                    $copia_imagen->thumbnail($tam['anchura'], $tam['altura']);
                    $copia_imagen->overlay(IMG_DEFAULT.'/masks/'.$tam['anchura'].'x'.$tam['altura'].'/mask'.$mascaras[$i]);
                    $copia_imagen->save($nombre_real.$mascaras[$i]);
                }
            }
        }
    }

    /**
     * Redimensiona la imagen tomando los limites definidos en la clase
     * @param	string $nombre	Nombre de salida del preview
     * @author Gabriel <gabriel.ortiz@corb.mx>
     * @access public
     */
    public function redimensionar($nombre){

        if(!file_exists(ARCHIVOS.'/small/')){
            exec('mkdir -m 777 '.ARCHIVOS.'/small');
        }
        $this->save(ARCHIVOS.'/'.$nombre);

        if($this->get_height() > $this->altura_maxima){
            $this->redimensionar_altura();

        }

    }

    /**
     * Redimensiona la imagen tomando como limite la altura maxima
     * @author Gabriel <gabriel.ortiz@corb.mx>
     * @access private
     */
    private function redimensionar_altura(){

        $ratio = ($this->anchura_maxima / $this->get_width() > $this->altura_maxima/ $this->get_height()
          ? $this->altura_maxima / $this->get_height()
          : $this->altura_maxima / $this->get_height()
        );
        if ( $this->get_height() > $this->altura_maxima) {
          $anchura= $this->get_width() * $ratio;
          $altura= $this->get_height() * $ratio;

        }

        $this->resize($anchura,$altura);

    }
    
    /**
     * Redimensiona la imagen tomando como limite la anchura maxima
     * @author Gabriel <gabriel.ortiz@corb.mx>
     * @access private
     */
    private function redimensionar_anchura(){
        $ratio = ($this->anchura_maxima / $this->get_width() < $this->altura_maxima/ $this->get_height()
          ? $this->anchura_maxima / $this->get_width()
          : $this->anchura_maxima / $this->get_width()
        );
        if ($this->get_width() > $this->anchura_maxima || $this->get_height() > $this->altura_maxima) {
          $anchura= $this->get_width() * $ratio;
          $altura= $this->get_height() * $ratio;

        }

        $this->resize($anchura,$altura);
    }
    
    /**
     * Genera un preview de la imagen
     * @param	string $nombre	Nombre de salida del preview
     * @author Gabriel <gabriel.ortiz@corb.mx>
     * @access public
     */
    public function genera_preview($nombre){

        if(!file_exists(ARCHIVOS.'/thumbnails/previews')){
            exec('mkdir -m 777 '.ARCHIVOS.'/thumbnails/previews');
        }
        $this->fit_to_height(100);
        if( $this->get_width() > 70 ) {
            $this->thumbnail(70,50);
        }
        $this->save(ARCHIVOS.'/thumbnails/previews/'.$nombre);

    }
    
    /**
     * Genera un preview pequeño de una imagen
     * @param	string $nombre	Nombre de salida del preview
     * @author Gabriel <gabriel.ortiz@corb.mx>
     * @access public
     */
    public function genera_preview_small($nombre){

        if(!file_exists(ARCHIVOS.'/small')){
            exec('mkdir -m 777 '.ARCHIVOS.'/small');
        }
        $this->fit_to_height(100);
        if( $this->get_width() > 70 ) {
            $this->thumbnail(70,50);
        }
        $this->save(ARCHIVOS.'/small/'.$nombre);

    }
    
    /**
     * Genera un preview pequeño de la imagen de un pdf
     * @param   string $nombre	Nombre de salida del preview
     * @author Gabriel <gabriel.ortiz@corb.mx>
     * @access public
     */
    public function genera_preview_pdf($nombre){
        if(!file_exists(ARCHIVOS.'/previews/small')){
            exec('mkdir -m 777 '.ARCHIVOS.'/previews/small');
        }

        //$this->best_fit(150,150);
        $this->fit_to_height(100);
        if( $this->get_width() > 70 ) {
            $this->thumbnail(70,50);
        }

        $this->save(ARCHIVOS.'/previews/small/'.$nombre);
    }
}

?>
